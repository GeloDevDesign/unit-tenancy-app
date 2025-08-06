<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\GeneralSetting;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Validation\Rule;
use App\Models\HistoryUnit;
use Carbon\Carbon;



class UnitController extends Controller
{
    public function index(Request $request)
    {

        $query = Unit::with(['property', 'tenantManager', 'occupant', 'latestHistory']);



        if ($search = $request->input('search')) {
            $query->where('unit_number', 'like', '%' . $search . '%')
                ->orWhere('building', 'like', '%' . $search . '%');
        }


        $units = $query->latest()->paginate(10);




        return view('unit.index', [
            'title' => 'All Properties',
            'units' => $units,
            'filters' => $request->only('search'),
        ]);
    }

    public function create()
    {
        $title = 'Unit - Dashboard';

        $generalSettings = GeneralSetting::find(1);
        $contents = optional($generalSettings)->dashboard_text ?? '';

        $nextUnitNumber = $this->getNextUnitNumber();

        $tenantManagers = User::with('roles')
            ->whereHas('roles', fn($q) => $q->where('name', 'tenant_manager'))
            ->get(['id', 'first_name', 'last_name', 'email']);

        $properties = Property::with('user')
            ->get(['id', 'name', 'building'])
            ->values();

        $buildingNumber = Property::with('user')->get(['id', 'building']);

        return view('unit.create', compact('title', 'contents', 'nextUnitNumber', 'buildingNumber', 'tenantManagers', 'properties'));
    }

    public function store(StoreUnitRequest $request)
    {
        $validated = $request->only([
            'tenant_manager',
            'unit_number',
            'floor',
            'capacity_count',
            'sqm_size',
            'property_id'
        ]);

        $nextUnitNumber = $this->getNextUnitNumber();
        $property = $request->user()->properties()->findOrFail($validated['property_id']);

        $paddedUnitNumber = str_pad($nextUnitNumber, 5, '0', STR_PAD_LEFT);
        $unitNumber = "{$validated['floor']}-{$paddedUnitNumber}-{$property->building}";

        if (Unit::where('unit_number', $unitNumber)->exists()) {
            return back()->withErrors(['unit_number' => 'The generated unit number already exists.'])->withInput();
        }

        $unit = $property->units()->create([
            'tenant_manager_id' => $validated['tenant_manager'],
            'unit_number' => $unitNumber, // ✅ Use the actual generated number
            'floor' => $validated['floor'],
            'capacity_count' => $validated['capacity_count'],
            'sqm_size' => $validated['sqm_size']
        ]);

        return to_route('unit.index')->withSuccess('Unit has been created successfully.');
    }




    /**
     * ✅ Show the form for editing
     */
    public function edit(Unit $unit)
    {
        $title = 'Edit Unit';

        // Split unit number: "2-00002-A"
        $parts = explode('-', $unit->unit_number);

        // Get the middle part (ID number) and remove leading zeros
        $unformattedId = ltrim($parts[1], '0'); // from "00002" ➜ "2"

        $tenantManagers = User::with('roles')
            ->whereHas('roles', fn($q) => $q->where('name', 'tenant_manager'))
            ->get(['id', 'first_name', 'last_name', 'email']);

        $properties = Property::with('user')
            ->get(['id', 'name', 'building']);


        $buildingNumber = Property::with('user')->get(['id', 'building']);

        return view('unit.edit', compact(
            'unit',
            'title',
            'buildingNumber',
            'properties',
            'unformattedId',
            'tenantManagers'
        ));
    }


    public function show_occupant(Request $request, Unit $unit)
    {

        $title = 'Edit Unit Occupant';

        $ownersAndTenants  = User::with('roles')
            ->whereHas('roles', fn($q) => $q->whereIn('name', ['tenant', 'owner']))
            ->get(['id', 'first_name', 'last_name', 'email']);

        return view('unit.edit-occupant', compact(
            'unit',
            'title',
            'ownersAndTenants'
        ));
    }


    public function occupant_update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'occupant_id' => 'nullable|exists:users,id',
            'status' => 'required|in:move_in,move_out',
            'move_date' => 'required|date',
        ]);

        // Format date: mm/dd/yyyy to yyyy-mm-dd
        $formattedDate = Carbon::createFromFormat('m/d/Y', $validated['move_date'])->format('Y-m-d');

        // Check if the user is trying to move in but the unit is already occupied
        if ($unit->occupied && $validated['status'] === 'move_in') {
            return back()->withErrors(['status' => 'This unit is already occupied.'])->withInput();
        }

        if ($validated['status'] === 'move_in' && $validated['occupant_id'] && !$unit->occupant) {
            // Fetch role of the new occupant (not the current occupant)
            $newOccupant = User::find($validated['occupant_id']);
            $newOccupantRole = $newOccupant?->roles()->pluck('name')->first() ?? 'no role';

            // Update unit to assign new occupant
            $unit->update([
                'occupant_id' => $validated['occupant_id'],
                'occupant_type' => $newOccupantRole,
                'status' => 'occupied',
            ]);

            // Create move-in history
            $unit->histories()->create([
                'occupant_id' => $validated['occupant_id'],
                'move_in' => $formattedDate,
                'move_out' => null,
                'status' => 'move_in',
            ]);
        } else {
            // Get previous occupant role before clearing it
            $previousOccupantRole = $unit->occupant?->roles()->pluck('name')->first() ?? 'no occupant';

            // Create move-out history
            $unit->histories()->create([
                'occupant_id' => $validated['occupant_id'],
                'move_in' => null,
                'move_out' => $formattedDate,
                'status' => 'move_out',
            ]);

            // Clear occupant from the unit
            $unit->update([
                'occupant_id' => null,
                'occupant_type' => $previousOccupantRole,
                'status' => 'available',
            ]);
        }

        return to_route('unit.index')->withSuccess('Unit updated successfully.');
    }




    /**
     * ✅ Update the unit in storage
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $validated = $request->only([
            'tenant_manager',
            'property_id',
            'unit_number',
            'floor',
            'capacity_count',
            'sqm_size'
        ]);

        // Get the property and its building
        $property = $request->user()->properties()->findOrFail($validated['property_id']);

        // Format unit number as: floor-00001-building
        $paddedUnitId = str_pad($validated['unit_number'], 5, '0', STR_PAD_LEFT);
        $unitNumber = "{$validated['floor']}-{$paddedUnitId}-{$property->building}";

        // Check for duplicate unit number, excluding the current unit
        $exists = Unit::where('unit_number', $unitNumber)
            ->where('id', '!=', $unit->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'unit_number' => "This unit number {$unitNumber} already exists."
            ])->withInput();
        }

        $unit->update([
            'tenant_manager_id' => $validated['tenant_manager'],
            'unit_number' => $unitNumber,
            'building' => $property->building,
            'floor' => $validated['floor'],
            'capacity_count' => $validated['capacity_count'],
            'sqm_size' => $validated['sqm_size'],
        ]);

        return to_route('unit.index')->withSuccess('Unit updated successfully.');
    }




    /**
     * ✅ Delete the unit from storage
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return to_route('unit.index')->withSuccess('Unit deleted successfully.');
    }

    private function getNextUnitNumber(): int
    {
        $unitCount = Property::withCount('units')->first();
        return optional($unitCount)->units_count + 1;
    }
}
