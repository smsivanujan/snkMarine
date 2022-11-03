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
        Schema::create('igms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id')->unsigned();
            $table->String('customs_office_code');
            $table->integer('igm_india_voyage_id')->unsigned();
            $table->date('date_of_departure');
            $table->date('date_of_arrival');
            $table->time('time_of_arrival');
            $table->integer('total_number_of_bols');
            $table->integer('total_number_of_packages');
            $table->integer('total_number_of_containers');
            $table->decimal('total_gross_mass',10,2);
            // $table->integer('client_id_carrier');
            $table->integer('consolidated_cargo');
            $table->String('place_of_loading_code');
            $table->String('place_of_unloading_code');
            $table->String('exporter_name');
            $table->longText('exporter_address');
            $table->integer('number_of_packages');
            $table->String('package_type_code');
            $table->decimal('gross_mass',10,2);
            $table->longText('shipping_marks');
            $table->decimal('volume_in_cubic_meters',10,2);
            $table->integer('num_of_ctn_for_this_bol');
            $table->integer('mode_of_transport_code');
            $table->String('identity_of_transporter');
            $table->String('nationality_of_transporter_code');
            $table->String('slpa_ref_number');
            $table->String('bol_reference');
            $table->integer('line_number');
            $table->integer('bol_nature');
            $table->String('bol_type_code');
            $table->String('place_of_departure_code');
            $table->String('place_of_destination_code');
            $table->String('unique_carrier_reference');
            $table->integer('client_id_carrier')->unsigned();
            $table->integer('client_id_notify')->unsigned();
            $table->integer('client_id_cosignee')->unsigned();
            $table->integer('freight_value');
            $table->String('freight_currency');
            $table->longText('goods_description')->nullable();
            $table->integer('deleted');
            $table->timestamps();
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('client_id_carrier')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_notify')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_cosignee')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igms');
    }
};
