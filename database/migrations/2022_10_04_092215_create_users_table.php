<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('full_name');
            $table->string('user_name');
            $table->string('email');
            $table->integer('user_group');
            $table->integer('own_bc');
            $table->longText('password');
            $table->integer('timezone_id')->unsigned();
            $table->integer('is_active');
            $table->dateTime('last_login');
            $table->dateTime('last_logout');
            $table->integer('is_online');
            $table->integer('is_delete');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('timezone_id')->references('id')->on('timezones')->onDelete('cascade');
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
};
