
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietiesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societies_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id')->unsigned();
            $table->string('image');
            $table->string('doc');
            $table->string('pdf');
            $table->timestamps();

            $table->foreign('society_id')
                ->references('id')->on('societies')
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
        Schema::drop('societies_files');
    }
}
