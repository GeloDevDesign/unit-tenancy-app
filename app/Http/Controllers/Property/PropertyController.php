<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;


class PropertyController extends Controller
{

    public function index(Request $request)
    {
        $query = Property::with('user');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%');
        }

        $properties = $query->latest()->paginate(10);



        return view('property-manager.index', [
            'title' => 'All Properties',
            'properties' => $properties,
            'filters' => $request->only('search'),
        ]);
    }




    public function create()
    {
        $title = 'Property - Dashboard';

        $property = [];
        $generalSettings = GeneralSetting::find(1);
        $contents = optional($generalSettings)->dashboard_text ?? '';

        $filters  = [];

        return view('property-manager.create', compact('title', 'contents',  'filters', 'property'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:100|string',
            'location' => 'required|max:255|string',
            'building' => ['required', 'string', 'regex:/^[A-Za-z]{2,5}$/']

        ]);

        $property = $request->user()->properties()->create($validated);

        return to_route('property.index')->withSuccess('Property has been created successfully');
    }


    public function show(Property $property)
    {


        $title = 'Edit Property Info';

        return view('property-manager.index', compact('title', 'property'));
    }

    public function edit(Property $property)
    {

        $title = 'Edit Property Info';

        return view('property-manager.edit', compact('title', 'property'));
    }


    public function update(Request $request, Property $property)
    {

        $validated = $request->validate([
            'name' => 'required|max:100|string',
            'location' => 'required|max:255|string'
        ]);


        $property->update($validated);

        return to_route('property.index')->withSuccess('Property has been updated successfully');
    }


    public function destroy(Property $property)
    {
        $property->delete();

        return to_route('property.index')->withSuccess('Property has been deleted successfully');
    }
}
