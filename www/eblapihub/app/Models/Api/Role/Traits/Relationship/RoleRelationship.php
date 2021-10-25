<?php

namespace App\Models\Api\Role\Traits\Relationship;

use App\Models\Api\Company\Company;
use App\Models\Api\Permission\Permission;

/**
 * Class RoleRelationship
 */
trait RoleRelationship
{
    public function permission()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function allowCompany($company)
    {

        if (is_string($company)) {
            $company = Company::whereName($company)->firstOrFail();
        }
        return $this->companies()->sync($company, true);
    }

    public function allowTo($permission)
    {

        if (is_string($permission)) {
            $permission = Permission::whereName($permission)->firstOrFail();
        }
        return $this->permission()->sync($permission, true);;
    }
}
