<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('users')->insert([
            'username'   => 'admin',
            'email'      => 'admin@admin.com',
            'first_name' => 'admin',
            'last_name'  => 'admin',
            'role'       => 'administartor',
            'phone_number'=> 1234567890,    
            'password'   => Hash::make('admin'),
            'repeat_password'  => Hash::make('admin'),
        ]);

        DB::connection('mysql')->table('permissions')->insert([
            ['permission_name'   => 'user.create',],
            ['permission_name'   => 'user.read',],
            ['permission_name'   => 'user.delete',],
            ['permission_name'   => 'user.update',],
        
            ['permission_name'   => 'role.create',],
            ['permission_name'   => 'role.read',],
            ['permission_name'   => 'role.delete',],
            ['permission_name'   => 'role.update',],
        
            ['permission_name'   => 'temporary.create',],
            ['permission_name'   => 'temporary.read',],
            ['permission_name'   => 'temporary.delete',],
            ['permission_name'   => 'temporary.update',],

            ['permission_name'   => 'permanent.create',],
            ['permission_name'   => 'permanent.read',],
            ['permission_name'   => 'permanent.delete',],
            ['permission_name'   => 'permanent.update',],
        ]);


    }
}
