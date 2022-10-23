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
        Schema::create('arrival_notice_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arrival_notice_id')->unsigned();
            $table->longText('description')->nullable();
            $table->integer('unit')->nullable();
            $table->decimal('unit_cost',10,2)->nullable();
            $table->decimal('unit_charge',10,2)->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('currency_id_mycurrency')->unsigned()->nullable();
            $table->decimal('exchange_rate',10,2)->nullable();
            $table->decimal('amount_in',10,2)->nullable();
            $table->string('tax_description')->nullable();
            $table->string('tax')->nullable();
            $table->decimal('tax_amount',10,2)->nullable();
            $table->decimal('amount_final',10,2)->nullable();
            $table->decimal('payed',10,2)->nullable();
            $table->decimal('total_cost',10,2)->nullable();
            $table->decimal('total_cost_in',10,2)->nullable();
            $table->decimal('profit',10,2)->nullable();
            $table->decimal('profit_in',10,2)->nullable();
            $table->timestamps();
            $table->foreign('arrival_notice_id')->references('id')->on('arrival_noticies')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('currency_id_mycurrency')->references('id')->on('currencies')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrival_notice_charges');
    }
};
