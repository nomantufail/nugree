<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class PropertySubTypeTableSeeder extends Seeder
{
 public function run()
 {
     DB::table('property_sub_types')->insert([

         ['property_type_id'=>1,'sub_type'=>'Residential Plot'],
         ['property_type_id'=>1,'sub_type'=>'Commercial Plot'],
         ['property_type_id'=>1,'sub_type'=>'Agricultural Land'],
         ['property_type_id'=>1,'sub_type'=>'Industrial Land'],
         ['property_type_id'=>1,'sub_type'=>'Plot File'],
         ['property_type_id'=>1,'sub_type'=>'Plot Form'],

         ['property_type_id'=>2,'sub_type'=>'House'],
         ['property_type_id'=>2,'sub_type'=>'Flat'],
         ['property_type_id'=>2,'sub_type'=>'Upper Portion'],
         ['property_type_id'=>2,'sub_type'=>'Lower Portion'],
         ['property_type_id'=>2,'sub_type'=>'Farm House'],
         ['property_type_id'=>2,'sub_type'=>'Room'],
         ['property_type_id'=>2,'sub_type'=>'Penthouse'],

         ['property_type_id'=>3,'sub_type'=>'Office'],
         ['property_type_id'=>3,'sub_type'=>'Shop'],
         ['property_type_id'=>3,'sub_type'=>'Warehouse'],
         ['property_type_id'=>3,'sub_type'=>'Factory'],
         ['property_type_id'=>3,'sub_type'=>'Building'],
         ['property_type_id'=>3,'sub_type'=>'Other'],

     ]);
 }
}