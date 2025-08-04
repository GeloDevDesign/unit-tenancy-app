<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ServiceRequest;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\User;

class Unit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'property_id',
        'tenant_manager_id',
        'occupant_id',
        'unit_number',
        'bulding',
        'occupant_type',
        'floor',
        'capacity_count',
        'sqm_size',
        'status',
    ];


    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }


    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function tenantManager()
    {
        return $this->belongsTo(User::class, 'tenant_manager_id');
    }




    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
