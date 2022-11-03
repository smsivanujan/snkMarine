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
        Schema::create('igm_indias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id')->unsigned();
            $table->string('sender_id');
            $table->string('version_no');
            $table->string('message_id');
            $table->string('sequence');
            $table->date('date1');
            $table->time('time1');
            $table->string('pod1');
            $table->string('imo1');
            $table->string('call_sign1');
            $table->integer('igm_india_voyage_id')->unsigned();
            $table->integer('line_code');
            $table->string('line_pan');
            $table->string('master_name');
            $table->string('pod_code');
            $table->string('last_port1');
            $table->string('last_port2');
            $table->string('last_port3');
            $table->char('vessel_type1');
            $table->integer('poa');
            $table->string('cargo_des1');
            $table->dateTime('date_time');
            $table->string('light_house');
            $table->integer('igm_india_terminal_id')->unsigned();
            $table->char('same_bottom');
            $table->char('passenger_list');
            $table->char('ship_stores');
            $table->char('crew_effect');
            $table->char('crew_list');
            $table->char('maritime');
            $table->string('vessel_name');
            $table->string('arrival_date');
            $table->string('igm_number');
            $table->string('nationality');
            $table->integer('deleted');
            $table->timestamps();
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('igm_india_terminal_id')->references('id')->on('igm_india_terminals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igm_indias');
    }
};
