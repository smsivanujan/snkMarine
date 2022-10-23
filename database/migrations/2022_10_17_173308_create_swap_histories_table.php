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
        Schema::create('swap_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('swap_id')->unsigned();
            $table->string('status');
            $table->integer('equipment_id')->unsigned();
            $table->integer('client_id_agent')->unsigned();
            $table->timestamps();
            $table->foreign('swap_id')->references('id')->on('swaps')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->foreign('client_id_agent')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('swap_histories');
    }
};
