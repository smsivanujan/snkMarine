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
        Schema::create('detention_traffies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id_agent')->unsigned();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('free_days')->nullable();
            $table->integer('comm')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
            $table->foreign('client_id_agent')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detention_traffies');
    }
};
