<?php

use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Database\Seeder;

class AgencyTableSeeder extends Seeder
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
        foreach($users as $user) {
            $finalRecord[] =[
                'agency' => 'jr'.' '.$user->lName,
                'user_id' => $user->id,
                'mobile' => 03044567051..rand(1,1000000),
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'phone' => 03044567051..rand(1,100000),
                'email' => $user->email.rand(1,200000000),
                'address' => 'Lahore',
                'logo' => 'users/a87ff679a2f3e71d9181a67b7542122c/agencies/fe981f8a9c549000708b79eea5acead1/fe981f8a9c549000708b79eea5acead1.jpg',
                'slug'=>uniqid(),
            ];
        }
         DB::table('agencies')->insert($finalRecord);
    }
}
