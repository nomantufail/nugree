<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class ValidationRulesTableSeeder extends Seeder
{
 public function run()
 {
     DB::table('validation_rules')->insert([
         ['rule'=>'required']
     ]);
 }
}