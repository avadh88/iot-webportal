<?php

namespace App\Helpers;

class Helper
{
    /**
     * Check Permission
     *
     * @param string $permission
     * 
     * @return bool
     */
    public static function showBasedOnPermission($permission,$operator = ''){

        $role        = request()->session()->get('role');
        
        if($role == 'administrator'){
            return true;
        }
        else if(request()->session()->has('permission'))
        {
            $permissions = request()->session()->get('permission');

            if($operator == 'OR'){
                
                $result = array_intersect($permissions,$permission);

                if(count($result) > 0){
                    return true;
                }

                return false;

            }
            if($operator == 'AND'){
                
                $result = array_intersect($permissions,$permission);
                var_dump(($result));

                if(count($result) == count($permission)){
                    return true;
                }
            
                return false;
            }

            // if((in_array($permission,$permissions)))
            // {
            //     return true;
            // }
            // else{
            //     return false;
            // }   
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

    public function checkpermission(){

    }
}
