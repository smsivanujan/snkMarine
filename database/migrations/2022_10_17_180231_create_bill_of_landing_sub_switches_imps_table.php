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
        Schema::create('bill_of_landing_sub_switches_imps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bls_switch_id')->unsigned();
            $table->decimal('imp_freight_charge_in',10,2)->nullable();
            $table->decimal('imp_doc_fee',10,2)->nullable();
            $table->decimal('imp_thc_phc',10,2)->nullable();
            $table->decimal('exp_other_recovery',10,2)->nullable();
            $table->string('exp_other_recovery_remarks')->nullable();
            $table->decimal('exp_total_in',10,2)->nullable();
            $table->decimal('exp_agent_comm',10,2)->nullable();
            $table->decimal('exp_phc',10,2)->nullable();
            $table->decimal('imp_doc_charges',10,2)->nullable();
            $table->decimal('imp_freight_charge_ex',10,2)->nullable();
            $table->decimal('imp_dc_surcharge',10,2)->nullable();
            $table->decimal('imp_other_expenses',10,2)->nullable();
            $table->decimal('imp_other_expenses_remarks',10,2)->nullable();
            $table->decimal('imp_total_ex',10,2)->nullable();
            $table->decimal('imp_final_amount',10,2)->nullable();
            $table->longText('imp_remarks',10,2)->nullable();
            $table->date('imp_created_by')->nullable();
            $table->date('imp_created_date')->nullable();
            $table->longText('imp_approved_by')->nullable();
            $table->date('imp_approved_date')->nullable();
            $table->timestamps();
            $table->foreign('bls_switch_id')->references('id')->on('bill_of_landing_sub_switches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_of_landing_sub_switches_imps');
    }
};
