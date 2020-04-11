<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_details', function (Blueprint $table) {
            $table->bigIncrements('api_details_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('username');
            $table->string('password');
            $table->string('customer_no');
            $table->string('customer_name');
            $table->string('vending_username');
            $table->string('vending_password');
            $table->timestamps();
            $table->rememberToken();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_details');
    }
}
