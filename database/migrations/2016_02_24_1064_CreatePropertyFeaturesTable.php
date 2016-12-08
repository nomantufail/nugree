<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feature_section_id')->unsigned();
            $table->string('feature');
            $table->string('input_name')->unique();
            $table->integer('html_structure_id')->unsigned();
            $table->string('possible_values');
            $table->integer('priority');
            $table->timestamps();


            $table->foreign('feature_section_id')
                ->references('id')->on('feature_sections')
                ->onDelete('cascade');

            $table->foreign('html_structure_id')
                ->references('id')->on('html_structures')
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
        Schema::drop('property_features');
    }
}
