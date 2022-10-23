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
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_code')->unique();
            $table->string('vendor_name')->unique();
            $table->string('sub_code')->unique();
            $table->integer('country_id')->unsigned();
            $table->integer('port_id')->unsigned();
            $table->string('email',50)->unique()->nullable();
            $table->string('telephone_number');
            $table->string('fax');
            $table->string('mobile_number');  
            $table->string('contact_name');
            $table->longText('address');
            $table->longText('image')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('is_active');
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('port_id')->references('id')->on('ports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
};
