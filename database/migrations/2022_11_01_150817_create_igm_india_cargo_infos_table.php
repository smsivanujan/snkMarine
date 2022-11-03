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
        Schema::create('igm_india_cargo_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('igm_id')->unsigned();
            $table->string('pod2');
            $table->string('imo2');
            $table->string('call_sign2');
            $table->integer('igm_india_voyage_id')->unsigned();
            $table->integer('line_number');
            $table->integer('bill_of_landing_id')->unsigned();
            $table->string('pol_code');
            $table->string('pol_code_sub');
            $table->string('final_destination');
            $table->string('vessel_type2');
            $table->string('other_cargo');
            $table->string('local_cargo');
            $table->string('local_sfc');
            $table->integer('total_packages');
            $table->string('pkg_units');
            $table->decimal('total_gross',10,2);
            $table->string('gross_units');
            $table->string('marks_numbers');
            $table->longText('cargo_des2');
            $table->string('cargo_class');
            $table->string('ul_number');
            $table->integer('rail_number');
            $table->string('rail_operator');
            $table->string('train_road');
            $table->string('pan_number');
            $table->integer('client_id_consignee')->unsigned();
            $table->integer('client_id_notify')->unsigned();
            $table->integer('unit_count');
            $table->longText('shipping_from');
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->foreign('igm_id')->references('id')->on('igms')->onDelete('cascade');
            $table->foreign('igm_india_voyage_id')->references('id')->on('igm_india_voyages')->onDelete('cascade');
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('client_id_consignee')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_notify')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('igm_india_cargo_infos');
    }
};
