<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTargetedPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners_targeted_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->timestamps();


            $table->foreign('banner_id')
                ->references('id')->on('banners')
                ->onDelete('cascade');

            $table->foreign('page_id')
                ->references('id')->on('pages')
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
        Schema::drop('banners_targeted_Pages');
    }
}
