<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'relationship_to_emergency_contact'
    ];
}
