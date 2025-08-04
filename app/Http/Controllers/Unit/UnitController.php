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

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::with(['property', 'tenantManager', 'occupant']);

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
            ->get(['id', 'name'])
            ->unique('name')
            ->values();

        $buildingNumber = Property::with('user')->get(['id', 'building']);

        return view('unit.create', compact('title', 'contents', 'nextUnitNumber', 'buildingNumber', 'tenantManagers', 'properties'));
    }

    public function store(StoreUnitRequest $request)
    {

        $validated = $request->only([
            'tenant_manager',
            'unit_number',
            'building',
            'floor',
            'capacity_count',
            'sqm_size',
            'property_id'
        ]);

        $nextUnitNumber = $this->getNextUnitNumber();

        $paddedUnitNumber = str_pad($nextUnitNumber, 5, '0', STR_PAD_LEFT);
        $unitNumber = "{$validated['floor']}-{$paddedUnitNumber}-{$validated['building']}";

        if (Unit::where('unit_number', $unitNumber)->exists()) {
            return back()->withErrors(['unit_number' => 'The generated unit number already exists.'])->withInput();
        }

        $property = $request->user()->properties()->findOrFail($validated['property_id']);

        $unit = $property->units()->create([
            'tenant_manager_id' => $validated['tenant_manager'],
            'unit_number' => $unitNumber,
            'building' => $validated['building'],
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

        $nextUnitNumber = $this->getNextUnitNumber();

        $tenantManagers = User::with('roles')
            ->whereHas('roles', fn($q) => $q->where('name', 'tenant_manager'))
            ->get(['id', 'first_name', 'last_name', 'email']);

        $properties = Property::with('user')
            ->get(['id', 'name'])
            ->unique('name')
            ->values();

        $ownersAndTenants  = User::with('roles')
            ->whereHas('roles', fn($q) => $q->whereIn('name', ['tenant', 'owner']))
            ->get(['id', 'first_name', 'last_name', 'email']);

        $buildingNumber = Property::with('user')->get(['id', 'building']);

        return view('unit.edit', compact(
            'unit',
            'title',
            'nextUnitNumber',
            'buildingNumber',
            'tenantManagers',
            'properties',
            'unformattedId',
            'ownersAndTenants'
        ));
    }


    /**
     * ✅ Update the unit in storage
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $validated = $request->only([
            'tenant_manager',
            'unit_number',
            'building',
            'floor',
            'capacity_count',
            'sqm_size',
            'occupant_id'
        ]);

        if (!empty($validated['occupant_id'])) {
            $newOccupantRole = optional(User::find($validated['occupant_id']))
                ->roles()
                ->pluck('name')
                ->first();
        } else {
            $validated['occupant_id'] = null;
            $newOccupantRole = null;
        }


        // Format unit number as: floor-00001-building
        $paddedUnitId = str_pad($validated['unit_number'], 5, '0', STR_PAD_LEFT);
        $unitNumber = "{$validated['floor']}-{$paddedUnitId}-{$validated['building']}";

        // Check for duplicate unit number, excluding current unit
        $exists = Unit::where('unit_number', $unitNumber)
            ->where('id', '!=', $unit->id)
            ->exists();


        if ($exists) {
            return back()->withErrors([
                'unit_number' => "This unit number {$unitNumber} already exists."
            ])->withInput();
        }

        // Update the unit
        $unit->update([
            'tenant_manager_id' => $validated['tenant_manager'],
            'unit_number' => $unitNumber,
            'building' => $validated['building'],
            'floor' => $validated['floor'],
            'capacity_count' => $validated['capacity_count'],
            'sqm_size' => $validated['sqm_size'],
            'occupant_id' => $validated['occupant_id'] ?? null,
            'occupant_type' => $newOccupantRole ?? 'no occupant',
            'status' => $newOccupantRole ? 'occupied' : 'available'
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
