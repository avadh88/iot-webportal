<?php

namespace App\Models\Api\Company\Traits\Relationship;

use App\Models\Api\Application\Application;
use App\Models\Api\Permanent\PermanentModel;
use App\Models\Api\Role\Role;

/**
 * Class CompanyRelationship
 */
trait CompanyRelationship
{

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function devices()
    {
        return $this->hasMany(PermanentModel::class);
    }
}
