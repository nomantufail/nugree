<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/20/2016
 * Time: 2:12 PM
 */

namespace App\Traits;

use App\DB\Providers\SQL\Models\AssignedFeatures;
use App\Libs\Json\Creators\Creators\Feature\SectionsFeaturesJsonCreator;
use App\Repositories\Repositories\Sql\AssignedFeaturesJsonRepository;

trait AssignedFeaturesJsonDocumentsGenerator
{
    public function generate(array $sutTypeIds)
    {

        foreach($sutTypeIds as $sutTypeId)
        {
            $assignedFeatures = new AssignedFeatures();
              $assignedFeatures->subTypeId = $sutTypeId;
              $assignedFeatures->json = json_encode((new SectionsFeaturesJsonCreator($sutTypeId))->create());
             (new AssignedFeaturesJsonRepository())->updateWhere(['property_sub_type_id'=>$assignedFeatures->subTypeId],$assignedFeatures);
        }
        return true;
    }
}