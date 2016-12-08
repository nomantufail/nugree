<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->integer('purpose_id')->unsigned();  //completed
            $table->integer('property_sub_type_id')->unsigned();  //completed
            $table->integer('location_id')->unsigned();  //complete
            $table->string('title');
            $table->text('description');
            $table->double('price');
            $table->double('land_area');
            $table->integer('land_unit_id')->unsigned();    //complete
            $table->integer('property_status_id')->unsigned();    //complete

            $table->string('contact_person');
            $table->string('phone');
            $table->string('mobile');
            $table->string('fax');
            $table->string('email');
            $table->string('slug');
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_hot')->default(0);
            $table->integer('total_views')->default(0);
            $table->integer('rating')->default(0);
            $table->integer('total_likes')->default(0);
            $table->tinyInteger('wanted')->default(0);
            $table->tinyInteger('is_verified')->default(0);
            $table->softDeletes();
            $table->integer('created_by')->unsigned();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();

            /* Foreign Keys */
            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('purpose_id')
                ->references('id')->on('property_purposes')
                ->onDelete('cascade');
            $table->foreign('property_sub_type_id')
                ->references('id')->on('property_sub_types')
                ->onDelete('cascade');
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
            $table->foreign('land_unit_id')
                ->references('id')->on('land_units')
                ->onDelete('cascade');
            $table->foreign('property_status_id')
                ->references('id')->on('property_statuses')
                ->onDelete('cascade');
            $table->foreign('created_by')
                ->references('id')->on('users')
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
        Schema::drop('properties');
    }
}
