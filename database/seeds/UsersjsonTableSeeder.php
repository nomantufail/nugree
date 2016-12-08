<?php

use App\Libs\Json\Creators\Creators\User\UserJsonCreator;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersJsonTableSeeder extends Seeder
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
        foreach($users as $user)
        {
            $finalRecord[] = [
                'user_id'=>$user->id,
                'json'=>(new UserJsonCreator($user))->create()->encode()
            ];
        }
        DB::table('user_json')->insert($finalRecord);
    }
}
