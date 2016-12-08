<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
      $statusesSeeder = new PropertyStatusTableSeeder();
        $statuses = $statusesSeeder->getAllStatusIds();

            $allProperties = [];
            for($a = 1; $a <= 6; $a++)

            {
                $temp = [];
                $temp['purpose_id'] = rand(1,2);
                $temp['property_sub_type_id'] = rand(1,19);
                $temp['location_id'] = 630;
                $temp['title'] = 'This is my property';
                $temp['description'] = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'. rand(1,200002) ;
                $temp['price'] = rand(2000000,250000000);
                $temp['land_area'] = rand(1,20);
                $temp['land_unit_id'] = rand(1,4);
                $temp['wanted'] = rand(0,1);
                $temp['contact_person'] = 'ab'.rand(1,100000);
                $temp['phone'] = '0321450405'. rand(1,3) ;
                $temp['mobile'] = '0321450405'. rand(1,10);
                $temp['property_status_id'] = 5  /*$statuses[rand(0,(sizeof($statuses)-1))]*/;
                $temp['total_views'] = rand(1,100000);
                $temp['rating'] = rand(1,10);
                $temp['total_likes'] = rand(1,100000);
                $temp['email'] = 'jrpropedrty167@gmail.com'. rand(1,1000000) ;
                $temp['owner_id'] = rand(1,2);
                $temp['slug'] = 'this_is_property_title_'.rand(1,1000);
                $temp['created_by'] = 1;
                $temp['created_at'] = date('Y-m-d h:i:s');
                $temp['updated_at'] = date('Y-m-d h:i:s');
                $allProperties[] = $temp;

            }
            DB::table('properties')->insert($allProperties);

    }
}
