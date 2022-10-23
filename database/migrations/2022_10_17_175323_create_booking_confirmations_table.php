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
        Schema::create('booking_confirmations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('booking_confirmation_number')->unique();
            $table->integer('client_id_shipper')->unsigned();
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('port_net_ref')->nullable();
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->integer('port_id_loading')->unsigned()->nullable();
            $table->integer('port_id_discharge')->unsigned()->nullable();
            $table->string('place_of_delivery')->nullable();
            $table->string('place_of_receipt')->nullable();
            $table->longText('description')->nullable();
            $table->date('eta')->nullable();
            $table->date('closing_date')->nullable();
            $table->date('etd')->nullable();
            $table->date('eta_pod')->nullable();
            $table->integer('igm_india_voyage_id')->unsigned()->nullable();
            $table->string('voyage_number')->nullable();
            $table->string('measurement')->nullable();
            $table->string('type_of_shipment')->nullable();
            $table->string('release_reference')->nullable();
            $table->string('gross_weight')->nullable();
            $table->integer('type_of_unit_id')->unsigned()->nullable();
            $table->integer('vendor_id_yard')->unsigned()->nullable();
            $table->integer('quantity_of_unit')->unsigned()->nullable();
            $table->date('release_expire')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('status_1')->nullable();
            $table->string('status_2')->nullable();
            $table->timestamps();
            $table->foreign('client_id_shipper')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('port_id_loading')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_discharge')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('type_of_unit_id')->references('id')->on('type_of_units')->onDelete('cascade');
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
        Schema::dropIfExists('booking_confirmations');
    }
};
