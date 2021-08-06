<?php

namespace App\Helpers;

use Illuminate\Contracts\Session\Session;

class Helper
{
    /**
     * Check Permission
     *
     * @param string $permission
     * 
     * @return bool
     */
    public static function showBasedOnPermission($permission){

        $permissions = request()->session()->get('permission');

        if(request()->session()->has('permission'))
        {
            if((in_array($permission,$permissions)))
            {
                return true;
            }
            else{
                return false;
            }   
        }
    }

    /**
     * Check Role
     *
     * @param string $role
     * 
     * @return bool
     */
    public static function showBasedOnRole($role){
        
        $roles = request()->session()->get('role');

        if(request()->session()->has('role'))
        {
            if(($role == $roles))
            {
                return true;
            }
            else{
                return false;
            }   
        }
    }
}
