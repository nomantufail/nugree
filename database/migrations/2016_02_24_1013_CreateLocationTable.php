<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->string('location');
            $table->string('path');
            $table->integer('lat');
            $table->integer('long');
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->string('description')->nullable();
            $table->string('index')->nullable();
            $table->string('slug');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')->on('cities')
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
        Schema::drop('locations');
    }
}
