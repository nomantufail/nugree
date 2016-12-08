<?php

use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = (new UsersRepoProvider())->repo()->all();
        $finalRecord =[];
           foreach($users as $user){
               $finalRecord[]=[
                    "user_id" => $user->id,
                    "role_id" => 3,
                ];
            }


        DB::table('user_roles')->insert($finalRecord);
    }
}
