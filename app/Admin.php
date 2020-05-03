<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{   

    use HasRoles;
    

    protected $guard = 'admin';
    
    protected $fillable = [
        'name', 'username', 'password','email'
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        return null !== $this->role()->where('name', $role)->first();
    }

    public function hasRoles($roles)
    {
        return null !== $this->role()->whereIn('name', $roles)->first();
    }

    public function get_role()
    {
        return $this->role()->first();
    }
}
