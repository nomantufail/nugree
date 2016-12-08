<?php

use App\DB\Providers\SQL\Models\AssignedFeatures;
use App\DB\Providers\SQL\Models\PropertySubType;
use App\Libs\Json\Creators\Creators\Feature\SectionsFeaturesJsonCreator;
use App\Libs\Json\Creators\Creators\Feature\AssignFeaturesJsonCreator;
use App\Repositories\Repositories\Sql\PropertySubTypeRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignedFeaturesJsonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subType = new PropertySubTypeRepository();
        $sutTypes = $subType->all();
        $finalArray = [];
        foreach($sutTypes as $subType /* @var $subType PropertySubType::class */)
        {
            $assignedFeatures = new AssignedFeatures();
            $assignedFeatures->subTypeId = $subType->id;
            $assignedFeatures->json = json_encode((new AssignFeaturesJsonCreator($subType->id))->create());
            $finalArray[] = [
                'property_sub_type_id' => $assignedFeatures->subTypeId,
                'json' => $assignedFeatures->json,
            ];
        }

        DB::table('assigned_features_documents')->insert($finalArray);

    }
}
