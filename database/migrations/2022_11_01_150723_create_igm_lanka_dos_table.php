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
        Schema::create('igm_lanka_dos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id')->unsigned();
            $table->longText('serial_number');
            $table->integer('client_id_forwarding_agent')->unsigned();
            $table->integer('client_id_consignee')->unsigned();
            $table->date('do_expire');
            $table->integer('igm_india_voyage_id')->unsigned();
            $table->date('date_issue');
            $table->integer('vendor_id_warhouse')->unsigned();
            $table->integer('port_id_loading')->unsigned();
            $table->string('package_type');
            $table->integer('number_pkg');
            $table->string('number_in_word');
            $table->integer('twft');
            $table->integer('foft');
            $table->integer('foft_over');
            $table->integer('vendor_id_yard')->unsigned();
            $table->integer('deleted');
            $table->timestamps();
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('client_id_forwarding_agent')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_consignee')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('port_id_loading')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('vendor_id_yard')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igm_lanka_dos');
    }
};
