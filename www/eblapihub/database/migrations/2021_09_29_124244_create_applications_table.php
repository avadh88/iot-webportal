<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_company_id');
            $table->unsignedBigInteger('device_name');
            $table->string('app_name');
            $table->boolean('app_status');
            $table->string('app_image');
            $table->timestamps();

            $table->foreign('app_company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('device_name')->references('id')->on('permenent_device')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
