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
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('equipment_number')->unique();
            $table->integer('owner_id')->unsigned();
            $table->integer('type_of_unit_id')->unsigned();          
            $table->string('grade');
            $table->string('status');
            $table->integer('vendor_id_yard')->unsigned(); 
            $table->integer('client_id_agent')->unsigned();
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('type_of_unit_id')->references('id')->on('type_of_units')->onDelete('cascade');
            $table->foreign('vendor_id_yard')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::dropIfExists('equipments');
    }
};
