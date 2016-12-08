<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTargetedLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_targeted_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->timestamps();


            $table->foreign('banner_id')
                ->references('id')->on('banners')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')->on('locations')
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
        Schema::drop('banners_targeted_locations');
    }
}
