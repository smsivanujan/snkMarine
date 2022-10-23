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
        Schema::create('detention_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('detention_no');
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
            $table->longText('remarks')->nullable();
            $table->integer('total_days_detention')->nullable();
            $table->string('discount_type')->nullable();
            $table->integer('discount_input')->nullable();
            $table->decimal('previous_bill',10,2)->nullable();
            $table->decimal('total_amount',10,2)->nullable();
            $table->decimal('final_amount',10,2)->nullable();
            $table->integer('nos_units')->nullable();
            $table->decimal('grand_total',10,2)->nullable();
            $table->decimal('grand_total_this_invoice_unit',10,2)->nullable();
            $table->integer('payed')->nullable();
            $table->date('yard_suppose_date')->nullable();
            $table->integer('forign_currency_id')->unsigned()->nullable();
            $table->integer('tariff_id')->unsigned()->nullable();
            $table->integer('bl_free_days')->nullable();
            $table->decimal('exchange_rate',10,2)->nullable();
            $table->decimal('final_amount_tarrif',10,2)->nullable();
            $table->integer('local_currency_id')->unsigned()->nullable();
            $table->decimal('comm',10,2)->nullable();
            $table->string('status')->nullable();
            $table->string('status2')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('client_id_shipper')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_consignee')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('port_id_loading')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_discharge')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('forign_currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('tariff_id')->references('id')->on('detention_traffies')->onDelete('cascade');
            $table->foreign('local_currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detention_invoices');
    }
};
