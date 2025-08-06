<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Unit;

class HistoryUnit extends Model
{
    //

    protected $fillable = [
        'tenant_manager_id',
        'occupant_id',
        'unit_id',
        'move_in',
        'move_out',
        'status',
    ];


    public function unit()
    {
        $this->belongsTo(Unit::class);
    }
}
