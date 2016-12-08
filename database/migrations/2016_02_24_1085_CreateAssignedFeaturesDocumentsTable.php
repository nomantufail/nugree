<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignedFeaturesDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_features_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_sub_type_id')->unsigned();
            $table->text('json');
            $table->timestamps();

            $table->foreign('property_sub_type_id','property_sub_types_fk')
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
        Schema::drop('assigned_features_documents');
    }
}
