<?php

use Illuminate\Database\Seeder;

class AgencyStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo()->all();
        $finalRecord =[];
        foreach($users as $key => $user) {
            $finalRecord[] =['agency_id' => $key+1, 'user_id'=>$user->id];
        }
        DB::table('agency_staff')->insert($finalRecord);
    }
}
