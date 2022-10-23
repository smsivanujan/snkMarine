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
        Schema::create('equipment_sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipment_sale_id')->unsigned();
            $table->integer('equipment_id')->unsigned();
            $table->decimal('amount',10,2);
            $table->string('destination');
            $table->timestamps();
            $table->foreign('equipment_sale_id')->references('id')->on('equipment_sales')->onDelete('cascade');
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
        Schema::dropIfExists('equipment_sale_details');
    }
};
