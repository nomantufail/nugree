<?php

use Illuminate\Database\Seeder;

class PropertyPurposeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_purposes')->insert([
            ['purpose'=>'for-sale', 'display_name' => 'For Sale'],
            ['purpose'=>'for-rent', 'display_name' => 'For Rent']
        ]);

    }
}
