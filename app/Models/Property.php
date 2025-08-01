<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Unit;

class Property extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'property_manager_id',
        'name',
        'location',
        'building'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'property_manager_id');
    }


    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
