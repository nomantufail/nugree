<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertySubTypeAssignFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_sub_type_assigned_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_sub_type_id')->unsigned();
            $table->integer('property_feature_id')->unsigned();
            $table->timestamps();

            $table->foreign('property_sub_type_id')
                ->references('id')->on('property_sub_types')
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
        Schema::drop('property_sub_type_assigned_features');
    }
}
