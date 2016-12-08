<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $societies = (new \App\Repositories\Providers\Providers\SocietiesRepoProvider())->repo()->all();
        $blocks = range('A', 'Z');
        $finalBlocks = [];
        foreach($societies as $society)
        {
            foreach($blocks as $block)
            {
                $finalBlocks[] = [
                    'society_id' => $society->id,
                    'block' => $block
                ];
            }
            $finalBlocks[] = [
                'society_id' => $society->id,
                'block' => 'other'
            ];
        }
        DB::table('blocks')->insert($finalBlocks);
    }
}
