<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_id',
        'occupant_id',
        'amount_due',
        'amount_paid',
        'due_date',
        'payment_date',
        'status'
    ];
    //
}
