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
            'password'   => Hash::make('admin'),
            'repeat_password'  => Hash::make('admin'),
        ]);
        
    }
}
