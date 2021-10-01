<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Role extends Model
{
    use HasFactory,HasApiTokens;
    // protected $table      = 'roles';
    protected $fillable   = ['role_name'];

    public function permission(){
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function allowTo($permission){

        if(is_string($permission)){
            $permission = Permission::whereName($permission)->firstOrFail();
        }
        return $this->permission()->sync($permission,true);
    }

    public function list($model){
        if($model){
            $roleData = Role::select('id','role_name')->get();
            return $roleData;
        }
    }

    public function fetchPermissionById($id){
        if($id){

            $roles = Role::select('id','role_name')->find($id);
            $data = [];
            $i = 1;
            $data['role'] = $roles['role_name'];
            $data['id'] = $roles['id'];
            
            foreach ($roles->permission as $permission) {
                //
                $data['permission'][$i] = $permission['permission_name'];
                $i++;
            }

            return $data;
        }
    }

    public function givePermission($data){

        $userId   = Role::where('role_name', $data['role_name'])->value('id');
        $role     = Role::find($userId);
        $roleuser = User::find($userId);

        $permissions = [];
        $i = 0;
        if(isset($data['permission'])){
            foreach($data['permission'] as $permission){
                $permissions[$i]   = Permission::where('permission_name', $permission)->value('id');
                $i++;
            }
        }
        $role->allowTo($permissions);
        
        return $role;
    }

    public function deleteById($id){
        if($id){
            $deleteData = Role::where('id',$id)->delete();
            return $deleteData;
        }
    }

    public function addRole($data){
        $userModel                   = new Role();
        $userModel->role_name         = $data['role_name'];

        if($userModel->save()){
            $permissions = [];
            $i = 0;
            if(isset($data['permission'])){
                foreach($data['permission'] as $permission){
                    $permissions[$i]   = Permission::where('permission_name', $permission)->value('id');
                    $i++;
                }
            }
            $userModel->allowTo($permissions);

            return $userModel;
        }else{
            return false;
        }
    }
}
