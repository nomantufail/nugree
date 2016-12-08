<?php

use App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator;
use App\Repositories\Repositories\Sql\PropertiesRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesJsonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = (new PropertiesRepository())->all();
        $finalResult = [];
        foreach($properties as $property){
            $propertyJson = (new PropertyJsonCreator($property))->create();
            $finalResult[] = [ 'property_id' => $property->id, 'json'=> json_encode($propertyJson)];
        }
        DB::table('property_json')->insert($finalResult);
    }
}
