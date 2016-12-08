<?php

/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 4/26/2016
 * Time: 10:20 AM
 */
use Illuminate\Database\Seeder;
class PropertyDocumentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('property_documents')->insert([
            ['property_id'=>1,'type'=>'image','title'=>'This is image','path'=>'localhost'],
            ['property_id'=>2,'type'=>'image','title'=>'This is image','path'=>'localhost'],
            ['property_id'=>3,'type'=>'image','title'=>'This is image','path'=>'localhost']
        ]);
    }
}