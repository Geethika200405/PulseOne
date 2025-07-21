<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'dob',
        'mobile_number',
        'address',
        'is_active',
        'mfa_enabled',
        'total_points',
        'profile_image',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'dob'         => 'date',
        'is_active'   => 'boolean',
        'mfa_enabled' => 'boolean',
    ];

    /**
     * Roles relationship (Many-to-Many)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    /**
     * Check if user has a specific role by name
     */
    public function hasRole($roleName)
    {
        return $this->roles->contains('role_name', $roleName);
    }
}
