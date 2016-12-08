<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [ 'page'=>'index'],
            [ 'page'=>'agent-profile'],
            [ 'page'=>'agent_listing'],
            [ 'page'=>'property_detail'],
            [ 'page'=>'property_listing'],
         ]);
    }
}
