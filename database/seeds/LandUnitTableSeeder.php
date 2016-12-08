<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class LandUnitTableSeeder extends Seeder
{
 public function run()
 {
     DB::table('land_units')->insert([
         ['id' => 3, 'unit'=>'Marla'],
         ['id' => 4, 'unit'=>'Kanal'],
         ['id' => 1, 'unit'=>'square feet'],
         ['id' => 2, 'unit'=>'square yard'],
         ['id' => 5, 'unit'=>'square meter'],
         ['id' => 6, 'unit'=>'Acre'],
     ]);
 }
}