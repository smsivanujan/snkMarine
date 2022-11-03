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
        Schema::create('detention_traff_subs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detention_traffic_id')->unsigned();
            $table->string('tariff_name');
            $table->integer('slab_days')->nullable();
            $table->integer('slab_rate')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
            $table->foreign('detention_traffic_id')->references('id')->on('detention_traffies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detention_traff_subs');
    }
};
