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
        'occupant_id',
        'reviewed_by',
        'type',
        'notes',
        'request_date'
    ];
}
