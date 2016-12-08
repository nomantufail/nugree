<?php

use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Database\Seeder;

class AgencySocietyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = (new UsersRepoProvider())->repo()->all();
        $societies = (new SocietiesRepoProvider())->repo()->all();
        //dd($societies[0]->id);
        $finalRecord =[];
        foreach($users as $key=>$value)
        {
            $finalRecord[] = [
                'agency_id' => $value->id,
                'society_id' => $societies[$key]->id,
            ];
        }

         DB::table('agency_societies')->insert($finalRecord);
    }
}
