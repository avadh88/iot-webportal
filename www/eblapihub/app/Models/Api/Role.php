<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Role extends Model
{
    use HasFactory, HasApiTokens;
    // protected $table      = 'roles';
    protected $fillable   = ['role_name'];

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

        $userId   = Role::where('role_name', $data['role_name'])->value('id');
        $role     = Role::find($userId);


        $permissions = [];
        $companies   = [];
        $i = 0;
        $j = 0;
        if (isset($data['permission'])) {
            foreach ($data['permission'] as $permission) {
                $permissions[$i]   = Permission::where('permission_name', $permission)->value('id');
                $i++;
            }
        }

        if (isset($data['companyAccess'])) {
            foreach ($data['companyAccess'] as $companyId) {
                $companies[$j] = Company::where('id', $companyId)->value('id');
                $j++;
            }
        }

        $role->allowTo($permissions);
        $role->allowCompany($companies);


        return $role;
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
            $permissions = [];
            $companies   = [];
            $i = 0;
            $j = 0;

            if (isset($data['permission'])) {
                foreach ($data['permission'] as $permission) {
                    $permissions[$i]   = Permission::where('permission_name', $permission)->value('id');
                    $i++;
                }
            }
            if (isset($data['companyAccess'])) {
                foreach ($data['companyAccess'] as $companyId) {
                    $companies[$j] = Company::where('id', $companyId)->value('id');
                    $j++;
                }
            }
            $roleModel->allowCompany($companies);
            $roleModel->allowTo($permissions);
            return $roleModel;
        } else {
            return false;
        }
    }
}
