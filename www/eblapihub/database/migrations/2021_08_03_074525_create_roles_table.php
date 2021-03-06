<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role_name');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {;
            $table->bigIncrements('id');
            $table->string('permission_name');
            $table->timestamps();
        });


        Schema::create('permission_role', function (Blueprint $table) {
            $table->primary(['role_id','permission_id']);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
                  
                  
            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('company_id');
            $table->string('password');
            $table->string('repeat_password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        });

        
        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['user_id','role_id']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
                  

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
