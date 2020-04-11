<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailyReadings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_readings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('year');
            $table->unsignedBigInteger('month');
            $table->unsignedBigInteger('day');
            $table->unsignedBigInteger('units_used')->default(0);
            $table->unsignedBigInteger('units_remaining')->default(0);
            $table->boolean('reading_status')->default(1);
            $table->boolean('meter_status')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_readings');
    }
}
