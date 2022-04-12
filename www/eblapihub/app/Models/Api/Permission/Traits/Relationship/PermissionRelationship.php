<?php

namespace App\Models\Api\Permission\Traits\Relationship;

use App\Models\Api\Role\Role;

/**
 * Class PermissionRelationship
 */
trait PermissionRelationship
{
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
