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
        Schema::create('receipt_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_id')->unsigned()->nullable();
            $table->string('pay_type')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->decimal('current_bal',10,2)->nullable();
            $table->decimal('paying_amount',10,2)->nullable();
            $table->decimal('paying_local',10,2)->nullable();
            $table->string('status')->nullable();
            $table->integer('deleted')->nullable();
            $table->timestamps();
            $table->foreign('receipt_id')->references('id')->on('receipts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_payments');
    }
};
