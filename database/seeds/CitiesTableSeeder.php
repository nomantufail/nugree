<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['city' => 'lahore', 'country_id'=>1,'priority'=>11,'path'=>'assets/imgs/42_ads/assets/imgs/42_ads/1e6ae4ada992769567b71815f124fac5.jpg','title'=>'i am meta','keyword'=>'i am key woerd','description'=>'ok dex','index'=>'','slug'=>'lahore'],
            ['city' => 'Karachi', 'country_id'=>1,'priority'=>10,'path'=>'assets/imgs/42_ads/assets/imgs/42_ads/4a72287dca6a1251f24f948b5819c647.jpg','title'=>'i am meta','keyword'=>'i am key woerd','description'=>'ok dex','index'=>'','slug'=>'karachi'],
            ['city' => 'Islamabad', 'country_id'=>1,'priority'=>10,'path'=>'assets/imgs/42_ads/assets/imgs/42_ads/4a72287dca6a1251f24f948b5819c647.jpg','title'=>'i am meta','keyword'=>'i am key woerd','description'=>'ok dex','index'=>'','slug'=>'islambad'],
            ['city' => 'Gwadar', 'country_id'=>1,'priority'=>10,'path'=>'assets/imgs/42_ads/assets/imgs/42_ads/4a72287dca6a1251f24f948b5819c647.jpg','title'=>'i am meta','keyword'=>'i am key woerd','description'=>'ok dex','index'=>'','slug'=>'gwader'],
            ['city' => 'Faislabad', 'country_id'=>1,'priority'=>10,'path'=>'assets/imgs/42_ads/assets/imgs/42_ads/4a72287dca6a1251f24f948b5819c647.jpg','title'=>'i am meta','keyword'=>'i am key woerd','description'=>'ok dex','index'=>'','slug'=>'faisalabad'],
        ]);
    }
}
