<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['country' => 'Pakistan'],
            ['country' => 'India'],
            ['country' => 'France'],
            ['country' => 'Singapore'],
            ['country' => 'America'],
            ['country' => 'Nigeria']
        ]);
    }
}
