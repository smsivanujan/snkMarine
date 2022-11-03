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
        Schema::create('igm_lanka_do_containers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('igm_id')->unsigned();
            $table->integer('equipment_id')->unsigned();
            $table->string('seal_no');
            $table->string('description')->nullable();
            $table->decimal('weight',10,2);
            $table->string('measurement');
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
        Schema::dropIfExists('igm_lanka_do_containers');
    }
};
