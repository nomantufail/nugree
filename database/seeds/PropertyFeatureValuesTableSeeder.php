<?php

use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use Illuminate\Database\Seeder;

class PropertyFeatureValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $properties = (new PropertiesRepoProvider())->repo()->all();
        $features = (new FeaturesRepoProvider())->repo()->all();
        $allProperties = [];
        foreach($properties as $property)
        {
            foreach($features as $feature)
            {
                $temp = [];
                $temp['property_id'] = $property->id;
                $temp['property_feature_id'] = $feature->id;
                $temp['value'] = rand(1,10);
                $allProperties[] = $temp;

            }
        }
            $newArray = array_slice($allProperties, 0, 150, true);
            DB::table('property_feature_values')->insert($newArray);
    }

}
