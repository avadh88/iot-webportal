<?php

namespace App\Models\Api\Permanent\Traits\Relationship;

use App\Models\Api\Company\Company;

/**
 * Class PermanentRelationship
 */
trait PermanentRelationship
{
    public function companies()
    {
        return $this->belongsTo(Company::class)->withTimestamps();
    }
}
