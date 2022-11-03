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
        Schema::create('igm_india_containers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('igm_id')->unsigned();
            $table->integer('cargo_info_number');
            $table->string('pod');
            $table->string('imo');
            $table->string('vessel');
            $table->string('voyage');
            $table->integer('line');
            $table->integer('sub_line');
            $table->integer('equipment_id')->unsigned();
            $table->string('seal');
            $table->string('pan');
            $table->string('type');
            $table->integer('pkgs');
            $table->integer('gross_weight');
            $table->integer('con_code');
            $table->timestamps();
            $table->foreign('igm_id')->references('id')->on('igms')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igm_india_containers');
    }
};
