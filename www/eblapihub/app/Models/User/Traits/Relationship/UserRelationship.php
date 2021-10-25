<?php

namespace App\Models\User\Traits\Relationship;

use App\Models\Api\Company\Company;
use App\Models\Api\Role\Role;

/**
 * Class UserRelationship
 */
trait UserRelationship
{
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function compnies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function assignRoles($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }
        return $this->roles()->sync($role, true);
    }

    public function permission()
    {
        return $this->roles->map->permission->flatten()->pluck('permission_name')->unique();
    }
}
