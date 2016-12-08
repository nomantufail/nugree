<?php

use Illuminate\Database\Seeder;

class HtmlStructuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('html_structures')->insert([
            ['structure' => 'text'],
            ['structure' => 'number'],
            ['structure' => 'select'],
            ['structure' => 'textarea'],
            ['structure' => 'checkbox'],
            ['structure' => 'radio'],
            ['structure' => 'longtext'],
            ['structure' => 'description'],
        ]);
    }
}
