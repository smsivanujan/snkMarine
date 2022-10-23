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
        Schema::create('soa_subs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('soa_id')->unsigned();
            $table->integer('client_id_agent')->unsigned();
            $table->longText('description');
            $table->decimal('income',10,2);
            $table->string('expenses',10,2);
            $table->timestamps();
            $table->foreign('soa_id')->references('id')->on('soas')->onDelete('cascade');
            $table->foreign('client_id_agent')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soa_subs');
    }
};
