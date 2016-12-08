 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_searches', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('purpose_id')->unsigned();  //completed
                $table->integer('type_id')->unsigned();  //completed
                $table->integer('property_sub_type_id')->unsigned();  //completed
                $table->integer('country_id')->unsigned();  //completed
                $table->integer('city_id')->unsigned();  //completed
                $table->integer('location_id')->unsigned();  //completed
                $table->double('price_from');
                $table->double('price_to');
                $table->double('land_area_from');
                $table->double('land_area_to');
                $table->integer('land_unit_id')->unsigned();    //complete
                $table->string('email');
                $table->string('mobile');
                $table->mediumText('json');
                $table->timestamps();


            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_searches');
    }
}
