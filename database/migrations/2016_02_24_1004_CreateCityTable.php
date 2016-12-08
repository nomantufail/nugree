<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city');
            $table->integer('country_id')->unsigned();
            $table->integer('priority')->default(0);
            $table->string('path')->nullable();
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->string('description')->nullable();
            $table->string('index')->nullable();
            $table->string('slug');
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
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
        Schema::drop('cities');
    }
}
