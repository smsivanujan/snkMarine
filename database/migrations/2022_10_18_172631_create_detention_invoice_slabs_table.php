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
        Schema::create('detention_invoice_slabs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detention_invoice_id')->unsigned();
            $table->string('slab_no')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->timestamps();
            $table->foreign('detention_invoice_id')->references('id')->on('arrival_noticies')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detention_invoice_slabs');
    }
};
