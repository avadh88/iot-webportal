<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        DB::connection('mysql')->table('companies')->insert([
            'company_name'     => 'eByteLogic',
            'company_address'  => '1114, Ganesh Glory',
            'company_email'    => 'admin@admin.com',
            'company_mobile'   => 1234567890,
            'company_status'   => 0,
            'company_logo'     => "",
        ]);

        DB::connection('mysql')->table('roles')->insert([
            'role_name'     => 'administrator',
        ]);

        DB::connection('mysql')->table('users')->insert([
            'username'   => 'admin',
            'email'      => 'admin@admin.com',
            'first_name' => 'admin',
            'last_name'  => 'admin',
            'role_id'       => 1,
            'company_id'       => 1,
            'phone_number' => 1234567890,
            'password'   => Hash::make('admin'),
            'repeat_password'  => Hash::make('admin'),
        ]);

        DB::connection('mysql')->table('role_user')->insert([
            'user_id'   => 1,
            'role_id'      => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::connection('mysql')->table('permissions')->insert([
            [
                'permission_name'   => 'user.create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'user.read',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'user.delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'user.update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'permission_name'   => 'role.create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'role.read',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'role.delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'role.update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'permission_name'   => 'temporary.create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'temporary.read',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'temporary.delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'temporary.update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'permission_name'   => 'permanent.create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'permanent.read',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'permanent.delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'permanent.update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'permission_name'   => 'company.create',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'company.read',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'company.delete',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'permission_name'   => 'company.update',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ]);

        for ($i = 1; $i <= 20; $i++) {
            DB::connection('mysql')->table('permission_role')->insert([
                'role_id'   => 1,
                'permission_id'      => $i,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'  => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
