<?php

use Illuminate\Database\Seeder;

class MembershipPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('membership_plans')->insert([
            [
                'plan_name' => 'free',
                'featured' => 0,
                'hot' => 0
            ],
        ]);
    }
}
