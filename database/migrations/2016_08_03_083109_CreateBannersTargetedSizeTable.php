<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTargetedSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_targeted_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->integer('area');
            $table->string('unit');
            $table->timestamps();


            $table->foreign('banner_id')
                ->references('id')->on('banners')
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
        Schema::drop('banners_targeted_sizes');
    }
}
