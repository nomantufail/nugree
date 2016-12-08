<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedFeatureValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_feature_validations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_sub_type_assign_feature_id')->unsigned();
            $table->integer('validation_rule_id')->unsigned();
            $table->timestamps();


            $table->foreign('property_sub_type_assign_feature_id','property_sub_type_assign_feature_id_fk')
                ->references('id')->on('property_sub_type_assigned_features')
                ->onDelete('cascade');

            $table->foreign('validation_rule_id')
                ->references('id')->on('validation_rules')
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
        Schema::drop('assigned_feature_validations');
    }
}
