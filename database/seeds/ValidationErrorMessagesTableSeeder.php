<?php

use Illuminate\Database\Seeder;

class ValidationErrorMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('validation_error_messages')->insert([
            ['validation_rule_id' => 1, 'app_message_id' => 1],
        ]);
    }
}
