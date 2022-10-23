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
        Schema::create('bill_of_landing_subs_exps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_sub_id')->unsigned();
            $table->integer('ex_bc_id')->unsigned()->nullable();
            $table->date('ex_reserved_date')->nullable();
            $table->date('ex_shipper_date')->nullable();
            $table->decimal('exp_freight_charge',10,2)->nullable();
            $table->decimal('exp_dc_surcharge_in',10,2)->nullable();
            $table->decimal('exp_other_recovery',10,2)->nullable();
            $table->string('exp_other_recovery_remarks')->nullable();
            $table->decimal('exp_total_in',10,2)->nullable();
            $table->decimal('exp_slot_fees',10,2)->nullable();
            $table->decimal('exp_dc_surcharge_ex',10,2)->nullable();
            $table->decimal('exp_agent_comm',10,2)->nullable();
            $table->decimal('exp_phc',10,2)->nullable();
            $table->decimal('exp_total_expenses',10,2)->nullable();
            $table->decimal('exp_final_amount',10,2)->nullable();
            $table->longText('exp_remarks')->nullable();
            $table->date('exp_created_date')->nullable();
            $table->date('exp_approved_by')->nullable();
            $table->date('exp_approved_date')->nullable();
            $table->timestamps();
            $table->foreign('bill_of_landing_sub_id')->references('id')->on('bill_of_landing_subs')->onDelete('cascade');
            $table->foreign('ex_bc_id')->references('id')->on('booking_confirmations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_of_landing_subs_exps');
    }
};
