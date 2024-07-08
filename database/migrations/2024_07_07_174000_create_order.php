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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('sex');
            $table->string('email');
            $table->string('phone');
            $table->integer('age');
            $table->unsignedBigInteger('country');
            $table->foreign('country')->references('id')->on('country');
            $table->unsignedBigInteger('shipping_method');
            $table->foreign('shipping_method')->references('id')->on('shipping_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
