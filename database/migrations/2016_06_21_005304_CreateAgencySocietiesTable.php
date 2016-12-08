<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencySocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_societies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agency_id')->unsigned();
            $table->integer('society_id')->unsigned();
            $table->timestamps();

            $table->foreign('agency_id')
                ->references('id')->on('agencies')
                ->onDelete('cascade');

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
        Schema::drop('agency_societies');
    }
}
