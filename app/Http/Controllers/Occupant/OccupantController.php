<?php

namespace App\Http\Controllers\Occupant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\User;

class OccupantController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = $request->user()->occupiedUnits()->with(['property' => function ($q) {
            $q->withCount('units');
        }]);


        if ($search = $request->input('search')) {
            $query->where('unit_number', 'like', '%' . $search . '%')
                ->orWhere('building', 'like', '%' . $search . '%');
        }

        $units = $query->latest()->paginate(10);

        return view('occupant.index', [
            'title' => 'All Properties',
            'units' => $units,
            'filters' => $request->only('search'),
        ]);
    }
}
