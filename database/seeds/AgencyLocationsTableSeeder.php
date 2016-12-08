<?php

use Illuminate\Database\Seeder;

class AgencyLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agencies = (new \App\Repositories\Providers\Providers\AgenciesRepoProvider())->repo()->all();
        $location = (new \App\Repositories\Providers\Providers\LocationsRepoProvider())->repo()->first();
        $finalRecord =[];
        foreach($agencies as $key => $agency) {
            $finalRecord[] =['location_id' => $location->id, 'agency_id'=>$agency->id];
        }
        DB::table('agency_locations')->insert($finalRecord);
    }
}
