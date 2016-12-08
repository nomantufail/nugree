 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencyLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_locations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('agency_id')->unsigned();
                $table->integer('location_id')->unsigned();
                $table->timestamps();

                $table->foreign('agency_id')
                    ->references('id')->on('agencies')
                    ->onDelete('cascade');

                $table->foreign('location_id')
                    ->references('id')->on('locations')
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
        Schema::drop('agency_locations');
    }
}
