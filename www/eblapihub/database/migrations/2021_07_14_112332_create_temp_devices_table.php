<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempDevicesTable extends Migration
{
    protected $connection = 'mysql2';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->dropIfExists('temp_devices');

        Schema::connection('mysql2')->create('temp_devices', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('device_name');
            $table->string('serial_number');
            $table->string('status')->default(0);
            $table->string('temp_device_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_devices');
    }
}
