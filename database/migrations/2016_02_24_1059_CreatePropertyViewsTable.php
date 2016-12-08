<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address');
            $table->integer('property_id')->unsigned();
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')
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
        Schema::drop('property_views');
    }
}
