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
        Schema::create('igm_containers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('igm_id')->unsigned();
            $table->integer('bill_of_landing_id')->unsigned();
            $table->integer('no_of_packages');
            $table->integer('type_of_container');
            $table->integer('empty_Full');
            $table->integer('deleted');
            $table->timestamps();
            $table->foreign('igm_id')->references('id')->on('igms')->onDelete('cascade');
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igm_containers');
    }
};
