<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {

        $pageTitle = 'Properties - Dashboard';

        $generalSettings = GeneralSetting::find(1);
        $contents = optional($generalSettings)->dashboard_text ?? '';


        return view('property-manager.index', compact('pageTitle', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
