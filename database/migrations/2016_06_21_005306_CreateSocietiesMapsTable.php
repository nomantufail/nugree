<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietiesMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societies_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id')->unsigned();
            $table->string('path');
            $table->timestamps();


            $table->foreign('society_id')
                ->references('id')->on('societies')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('societies_maps');
    }
}