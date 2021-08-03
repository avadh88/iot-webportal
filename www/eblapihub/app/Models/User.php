<?php

namespace App\Models;

use App\Models\Api\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use RangeException;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username','email','first_name','last_name','phone_number','role','password','repeat_password'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRoles($role){
        if(is_string($role)){
            $role = Role::whereName($role)->firstOrFail();
        }
        return $this->roles()->sync($role,true);
    }

    public function permission(){
        return $this->roles->map->permission->flatten()->pluck('permission_name')->unique();
    }
    
    public function getPermissionById($id){
        $data =  User::find($id);
        $datas = $data->permission();
        return $datas;
    }


    public function verify($data){

        $userModel = User::select('id','username','email','password','role')->where('email', $data['username'])->orwhere('username',$data['username'])->first();
        return $userModel;
    }

    public function userList(){
        $data = User::select('id','username','email','role')->get();
        return $data;
    }

    public function addUser($data){
     
        
        $userModel                   = new User();

        $userModel->username         = $data['username'];
        $userModel->first_name       = $data['first_name'];
        $userModel->last_name        = $data['last_name'];
        $userModel->email            = $data['email'];
        $userModel->phone_number     = $data['phone_number'];
        $userModel->role             = $data['role'];
        $userModel->password         = Hash::make($data['password']);
        $userModel->repeat_password  = Hash::make($data['repeat_password']);

        $assignRole = Role::where('role_name', $data['role'])->value('id');
        
        if($userModel->save()){
            $userModel->assignRoles($assignRole);
            return $userModel;
        }else{
            return false;
        }
    }

    public function deleteById($id){

        $deleteData = User::where('id',$id)->delete();
        return $deleteData;
    }

    public function getUserById($id){
        
        if($id){
            $userModel = User::select('id','username','first_name','last_name','email','phone_number','role')->where('id',$id)->first();
            return $userModel;
        }
    }

    public function updateUser($data){
           
        $userModel                   = User::find($data['id']);

        $userModel->username         = $data['username'];
        $userModel->first_name       = $data['first_name'];
        $userModel->last_name        = $data['last_name'];
        $userModel->email            = $data['email'];
        $userModel->phone_number     = $data['phone_number'];
        $userModel->role             = $data['role'];

        $assignRole = Role::where('role_name', $data['role'])->value('id');


        if($userModel->save()){
            $userModel->assignRoles($assignRole);
            return $data;
        }else{
            return false;
        }
    }
}
