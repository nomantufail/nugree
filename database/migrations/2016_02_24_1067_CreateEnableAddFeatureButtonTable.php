<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnableAddFeatureButtonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enable_add_feature_buttons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_sub_type_id')->unsigned();
            $table->integer('enable_feature');
            $table->timestamps();

            $table->foreign('property_sub_type_id')
                ->references('id')->on('property_sub_types')
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
        Schema::drop('enable_add_feature_buttons');
    }
}
