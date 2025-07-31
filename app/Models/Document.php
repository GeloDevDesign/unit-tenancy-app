<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //

    protected  $fillable  = [
        'occupant_id',
        'unit_id',
        'document_type',
        'valid_id_image'
    ];
}
