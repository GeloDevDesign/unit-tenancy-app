<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Unit extends Model
{
    use SoftDeletes;
    //

    protected $fillable = [
        'property_id',
        'tenant_manager_id',
        'occupant_id',
        'unit_number',
        'floor',
        'capacity_count',
        'status'

    ];
}
