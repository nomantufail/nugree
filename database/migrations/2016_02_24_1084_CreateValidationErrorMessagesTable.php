<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidationErrorMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validation_error_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('validation_rule_id')->unsigned();
            $table->integer('app_message_id')->unsigned();
            $table->timestamps();



            $table->foreign('validation_rule_id')
                ->references('id')->on('validation_rules')
                ->onDelete('cascade');

            $table->foreign('app_message_id')
                ->references('id')->on('app_messages')
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
        Schema::drop('validation_error_messages');
    }
}
