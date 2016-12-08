<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class AppMessagesTableSeeder extends Seeder
{
 public function run()
 {
     DB::table('app_messages')->insert([
         ['short_message'=>'required', 'long_message' => 'this field is required'],
         ['short_message'=>'number', 'long_message' => 'this field should be a number']
     ]);
 }
}