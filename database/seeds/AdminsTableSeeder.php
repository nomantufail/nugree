<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                "name" => "Waqas",
                "role_id" => 1,
                "access_token" => "",
                "email" => "muhammad.waqas7266@gmail.com",
                "password" => bcrypt('123'),
            ]);
    }
}
