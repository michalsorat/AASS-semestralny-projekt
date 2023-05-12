<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->float('screen_size');
            $table->string('screen_resolution');
            $table->string('screen_type');
            $table->integer('cpu_cores');
            $table->float('cpu_frequency');
            $table->integer('ram');
            $table->integer('internal_storage');
            $table->integer('battery_capacity');
            $table->string('back_camera_resolution');
            $table->string('front_camera_resolution');
            $table->string('max_video_resolution');
            $table->string('operating_system');
            $table->string('connector');
            $table->string('network_connection');
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
        Schema::dropIfExists('parameters');
    }
}
