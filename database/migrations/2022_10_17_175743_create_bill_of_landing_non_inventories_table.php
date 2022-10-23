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
        Schema::create('bill_of_landing_non_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('bill_of_landing_number')->unique();
            $table->integer('booking_confirmation_id')->unsigned()->nullable();
            $table->integer('client_id_shipper')->unsigned()->nullable();
            $table->string('export_references')->nullable();
            $table->integer('client_id_consignee')->unsigned()->nullable();
            $table->integer('client_id_fw_agent')->unsigned()->nullable();
            $table->integer('client_id_notify')->unsigned()->nullable();
            $table->integer('port_id_loading')->unsigned()->nullable();
            $table->integer('port_id_discharge')->unsigned()->nullable();
            $table->integer('port_id_final_dest')->unsigned()->nullable();
            $table->integer('port_id_loading_bl')->unsigned()->nullable();
            $table->integer('port_id_discharge_bl')->unsigned()->nullable();
            $table->integer('port_id_final_dest_bl')->unsigned()->nullable();
            $table->integer('detention_free_days')->nullable();
            $table->longText('detention_description')->nullable();
            $table->string('pre_carriage_by')->nullable();
            $table->string('place_of_receipt')->nullable();
            $table->date('ship_on_board_date')->nullable();
            $table->integer('country_id_origin')->unsigned()->nullable();
            $table->integer('country_id_bltb_released')->unsigned()->nullable();
            $table->integer('igm_india_voyage_id')->unsigned()->nullable();
            $table->string('voyage_number')->nullable();
            $table->string('ocean_freight')->nullable();
            $table->integer('country_id_ocefrepayable')->unsigned()->nullable();
            $table->integer('traffic_mode_id')->unsigned()->nullable();
            $table->integer('no_of_bls')->nullable();
            $table->string('bl_type')->nullable();
            $table->longText('special_instructions')->nullable();
            $table->integer('shipper_loaded')->nullable();
            $table->string('status_1')->nullable();
            $table->string('status_2')->nullable();
            $table->timestamps();
            $table->foreign('booking_confirmation_id')->references('id')->on('booking_confirmations')->onDelete('cascade');
            $table->foreign('client_id_shipper')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_consignee')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_fw_agent')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_notify')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('port_id_loading')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_discharge')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_final_dest')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_loading_bl')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_discharge_bl')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('port_id_final_dest_bl')->references('id')->on('ports')->onDelete('cascade');
            $table->foreign('country_id_origin')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('country_id_bltb_released')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('country_id_ocefrepayable')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('traffic_mode_id')->references('id')->on('traffic_modes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_of_landing_non_inventories');
    }
};
