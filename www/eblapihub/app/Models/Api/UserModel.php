<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class UserModel extends Model
{
    use HasApiTokens,HasFactory;

    protected $connection = 'mysql';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['username','email','first_name','last_name','role','password','repeat_password'];

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRoles($role){

        if(is_string($role)){
            $role = Role::whereName($role)->firstOrFail();
        }
        return $this->roles()->sync($role,false);
    }
    
    
    public function verify($data){

        $userModel = UserModel::where('email', $data['username'])->orwhere('username',$data['username'])->first();
        return $userModel;
    }

    public function userList(){
        $data = UserModel::select('id','username','email','role')->get();
        return $data;
    }
}
