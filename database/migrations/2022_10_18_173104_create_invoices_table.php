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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('invoice_no');
            $table->integer('bill_of_landing_id')->unsigned()->nullable();
            $table->integer('client_id_shipper')->unsigned()->nullable();
            $table->integer('client_id_consignee')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->integer('port_id_loading')->unsigned()->nullable();
            $table->integer('port_id_discharge')->unsigned()->nullable();
            $table->integer('igm_india_voyage_id')->unsigned()->nullable();
            $table->date('etd_pol')->nullable();
            $table->date('eta_pod')->nullable();
            $table->date('st_expire')->nullable();
            $table->date('ata_fpd')->nullable();
            $table->string('obl_no')->nullable();
            $table->longText('shipment_type')->nullable();
            $table->integer('hbl_no')->nullable();
            $table->string('carrier')->nullable();
            $table->integer('nos_units')->nullable();
            $table->decimal('weight',10,2)->nullable();
            $table->string('cbm')->nullable();
            $table->longText('remarks')->nullable();
            $table->decimal('usd_rate',10,2)->nullable();
            $table->decimal('usd_tot',10,2)->nullable();
            $table->string('status')->nullable();
            $table->integer('tax_invoice')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('client_id_shipper')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_consignee')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('port_id_loading')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_discharge')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
