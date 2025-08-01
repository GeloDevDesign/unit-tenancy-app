<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspection extends Model
{
    use SoftDeletes;
    //

    protected  $fillable = [
        'unit_id',
        'inspected_by',
        'occupant_id',
        'inspection_type',
        'report_title',
        'damage_found',
        'notes',
        'report_date_time',
        'status'
    ];
}
