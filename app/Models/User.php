<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Property;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, LogsActivity,HasRoles;

    const TYPE_ADMIN = 'admin';
    const TYPE_REGULAR_ADMIN = 'regular_admin';

    const PROPERTY_MANAGER = 'property_manager';
    const OWNER = 'owner';
    const TENANT = 'tenant';
    const ACCOUNTANT = 'accountant';
    const TENANT_MANAGER = 'tenant_manager';


    public static $types = [
        self::TYPE_ADMIN => 'Super Admin',
        self::TYPE_REGULAR_ADMIN => 'Regular Admin',
        self::PROPERTY_MANAGER => 'Property Manager',
        self::TENANT => 'Tenant',
        self::TENANT_MANAGER => 'Tenant Manager',
        self::ACCOUNTANT => 'Accountant',
        self::OWNER => 'Owner'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'type',
        'email',
        'profile_picture',
        'password',
        'active',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    // RELATIONSHIPS
    // SCOPE
    // MUTATORS
    // HELPERS

    // activity logs config
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    protected static $logFillable = true;






    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = ucfirst($eventName) . ' User: ' . $this->full_name;
    }

    public function activityLogs()
    {
        $instance = $this;
        $activities = Activity::forSubject($instance)->orWhere(function ($query) use ($instance) {
            $query
                ->where('subject_type', ($this)->getMorphClass())
                ->where('subject_id', $instance->id);
        })->get();

        return $activities;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function scopeIsAdmin($query)
    {
        return $query->where('type', self::TYPE_ADMIN);
    }

    public function scopeAdmins($query)
    {
        return $query->whereIn('type', [self::TYPE_ADMIN, self::TYPE_REGULAR_ADMIN]);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name} ";
    }

    // public function full_name(): Attribute // laravel 9, another approach https://prnt.sc/IvLU_gvGg3Sl
    // {
    //     return \Attribute::get(
    //         fn($user) => "{$user->first_name} {$user->last_name}", // getter
    //         // set: fn($user) =>  do something here. // setter
    //     );
    // }

    public function getTypeNameAttribute()
    {
        return $this->type && isset(self::$types[$this->type]) ? self::$types[$this->type] : '';
    }

    public function getProfilePicPathAttribute()
    {
        return $this->profile_picture ? asset('storage/' . $this->profile_picture) : asset('storage/profile_pictures/default-user-icon.jpg');
    }

    public function getProfilePicFilenameAttribute()
    {
        return $this->profile_picture ? str_replace('profile_pictures/', '', $this->profile_picture) : 'default-user-icon.jpg';
    }

    public function getDefaultProfilePicPathAttribute()
    {
        return asset('storage/profile_pictures/default-user-icon.jpg');
    }


    public function isAdmin()
    {
        return $this->hasRole(self::TYPE_ADMIN);
    }

    public function isRegularAdmin()
    {
        return $this->hasRole(self::TYPE_REGULAR_ADMIN);
    }

    public function isTenant()
    {
        return $this->hasRole(self::TENANT);
    }

    public function isOwner()
    {
        return $this->hasRole(self::OWNER);
    }

    public function isAccountant()
    {
        return $this->hasRole(self::ACCOUNTANT);
    }


    public function isTenantManager()
    {
        return $this->hasRole(self::TENANT_MANAGER);
    }

    public function isPropertyManager()
    {
        return $this->hasRole(self::PROPERTY_MANAGER);
    }


    public function properties()
    {
        return $this->hasMany(Property::class,'property_manager_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            activity()->log('Created User: ' . $model->full_name)
                ->causedBy(authUser());

            if (Schema::hasColumn(app(self::class)->getTable(), 'column')) {
                $model->created_by = authUser()->id;
            }
        });

        static::deleting(function ($model) {
            activity()->log('Deleted User: ' . $model->full_name)
                ->causedBy(authUser());
        });
    }
}
