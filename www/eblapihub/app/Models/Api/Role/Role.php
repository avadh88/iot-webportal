<?php

namespace App\Models\Api\Role;

use App\Models\Api\Role\Traits\Relationship\RoleRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Role extends Model
{
    use HasFactory, HasApiTokens, RoleRelationship;
    // protected $table      = 'roles';
    protected $fillable   = ['role_name'];

    public function list($model)
    {
        if ($model) {
            $roleData = Role::select('id', 'role_name')->get();
            return $roleData;
        }
    }

    public function fetchPermissionById($id)
    {
        if ($id) {

            $roles = Role::select('id', 'role_name')->find($id);
            $data = [];
            $data['role']         = $roles['role_name'];
            $data['id']           = $roles['id'];
            $data['company_id']   = $roles->companies->flatten()->pluck('id')->unique();
            $data['permission']   = $roles->permission->flatten()->pluck('permission_name')->unique();

            return $data;
        }
    }

    public function givePermission($data)
    {
        $roleModel                   = Role::find($data['id']);
        $roleModel->role_name         = $data['role_name'];

        if ($roleModel->save()) {
            return $roleModel;
        }else {
            return false;
        }
    }

    public function deleteById($id)
    {
        if ($id) {
            $deleteData = Role::where('id', $id)->delete();
            return $deleteData;
        }
    }

    public function addRole($data)
    {
        $roleModel                    = new Role();
        $roleModel->role_name         = $data['role_name'];

        if ($roleModel->save()) {
            // $permissions = [];
            // $companies   = [];
            // $i = 0;
            // $j = 0;

            // if (isset($data['permission'])) {
            //     foreach ($data['permission'] as $permission) {
            //         $permissions[$i]   = Permission::where('permission_name', $permission)->value('id');
            //         $i++;
            //     }
            // }
            // if (isset($data['companyAccess'])) {
            //     foreach ($data['companyAccess'] as $companyId) {
            //         $companies[$j] = Company::where('id', $companyId)->value('id');
            //         $j++;
            //     }
            // }
            // $roleModel->allowCompany($companies);
            // $roleModel->allowTo($permissions);
            return $roleModel;
        } else {
            return false;
        }
    }
}
