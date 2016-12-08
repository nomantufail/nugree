<?php

use Illuminate\Database\Seeder;

class SocietiesFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('societies_files')->insert([
            ['society_id' => 1,'image'=>'web-apps/frontend/v2/images/societies/files/1.jpg','doc'=>'web-apps/frontend/v2/images/societies/files/1.docx','pdf'=>'web-apps/frontend/v2/images/societies/files/1.PDF'],
         ]);
    }
}
