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
        Schema::create('bill_of_landing_sub_switches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_of_landing_id')->unsigned()->unique();
            $table->integer('equipment_id')->unsigned()->nullable();
            $table->string('seal_no')->nullable();
            $table->string('marks')->nullable();
            $table->integer('package_quantity')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('gross_weight',10,2)->nullable();
            $table->decimal('measurement',10,2)->nullable();
            $table->integer('bill_confirmation_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('ignore_data')->nullable();
            $table->date('reserved_date')->nullable();
            $table->date('shipper_date')->nullable();
            $table->date('on_job_date')->nullable();
            $table->date('yard_in_date')->nullable();
            $table->integer('client_id_agent')->unsigned()->nullable();
            $table->integer('client_id_ex_agent')->unsigned()->nullable();
            $table->integer('vendor_id_yard')->unsigned()->nullable();
            $table->integer('free_days')->nullable();
            $table->integer('free_days_standard')->nullable();
            $table->date('ata_fpd')->nullable();
            $table->date('payed_till')->nullable();
            $table->string('soa_status_exp')->nullable();
            $table->string('soa_status_imp')->nullable();
            $table->decimal('lift_on_off',10,2)->nullable();
            $table->decimal('other_expenses',10,2)->nullable();
            $table->longText('other_expenses_remarks')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
            $table->foreign('bill_of_landing_id')->references('id')->on('bill_of_landings')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');
            $table->foreign('client_id_agent')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('client_id_ex_agent')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('bill_of_landing_sub_switches');
    }
};
