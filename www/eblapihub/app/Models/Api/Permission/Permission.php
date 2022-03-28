<?php

namespace App\Models\Api\Permission;

use App\Models\Api\Permission\Traits\Relationship\PermissionRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Permission extends Model
{
    use HasFactory, HasApiTokens, PermissionRelationship;
    // protected $table      = 'permissions';
    protected $fillable   = ['permission_name'];

    public function savePermissions($permissionsData){

        $permissions = [];
        $i           = 0;
        foreach ($permissionsData as $permission) {
            $permissions[$i]   = Permission::where('permission_name', $permission)->value('id');
            $i++;
        }

        return $permissions;
    }
}
