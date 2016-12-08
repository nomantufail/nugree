<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyFeatureValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_feature_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('property_feature_id')->unsigned();
            $table->string('value');
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');
            $table->foreign('property_feature_id')
                ->references('id')->on('property_features')
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
        Schema::drop('property_feature_values');
    }
}
