<?php

use Illuminate\Database\Seeder;

class FeatureSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_sections')->insert([
            ['section' => 'Main Features', 'priority' => 7],
            ['section' => 'Business and Communication', 'priority' => 6],
            ['section' => 'Nearby Locations and Other Facilities', 'priority' => 5],
            ['section' => 'Rooms', 'priority' => 4],
            ['section' => 'Healthcare Recreational', 'priority' => 3],
            ['section' => 'Other Facilities', 'priority' => 2],
            ['section' => 'Plot Feature', 'priority' => 1],

        ]);
    }
}
