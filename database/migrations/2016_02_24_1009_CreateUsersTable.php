<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('access_token', 60)->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->tinyInteger('user_type')->default();
            $table->string('address');
            $table->string('zipcode')->nullable();
            $table->integer('country_id')->unsigned();
            $table->tinyInteger('notification_settings');
            $table->integer('membership_plan_id')->unsigned();
            $table->integer('membership_status');
            $table->integer('login_count');
            $table->boolean('trusted_agent')->default(0);
            $table->integer('priority')->default(0);
            $table->string('slug');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
            $table->foreign('membership_plan_id')
                ->references('id')->on('membership_plans')
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
        Schema::drop('users');
    }
}
