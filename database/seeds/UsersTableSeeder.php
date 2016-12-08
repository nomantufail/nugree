<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $finalRecord =[];
            for($i=0;$i<10;$i++){
                $finalRecord[] = [
                    "f_name" => "waqas".rand(1,207777770),
                    "l_name" => "qureshi".rand(1,200222),
                    "email" => "waqas@gmail.com".$i,
                    "password" => bcrypt('123'),
                    "access_token" => "",
                    "phone" => "65464654",
                    "mobile" => "6546456",
                    "fax" => "",
                    "address" => "654564564",
                    "zipcode" => "54564564",
                    "trusted_agent" =>1,
                    "country_id" => 1,
                    "notification_settings" => 1,
                    "membership_plan_id" => 1
                ];
            }


        DB::table('users')->insert($finalRecord);
    }
}
