<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->default('');
            $table->string('address')->default('');
            $table->string('meter_no')->default('');
            $table->string('dcu_no')->default('');
            $table->string('last_login')->default('');
            $table->longText('dates_unread')->nullable();
            $table->timestamps();
            $table->rememberToken();
            $table->boolean('isAdmin')->default(false);
            $table->integer('admin_level')->default(0);
            $table->integer('admin_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
