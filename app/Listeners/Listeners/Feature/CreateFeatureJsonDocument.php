<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 11:50 AM
 */

namespace App\Listeners\Listeners\Feature;


use App\DB\Providers\SQL\Models\AssignedFeatures;
use App\Events\Events\Feature\FeatureJsonCreated;
use App\Libs\Json\Creators\Creators\Feature\SectionFeaturesJsonCreator;
use App\Libs\Json\Creators\Creators\Feature\SectionsFeaturesJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\AssignedFeaturesJsonRepository;

class CreateFeatureJsonDocument extends Listener implements ListenerInterface
{
    public function handle(FeatureJsonCreated $event)
    {
         $assignedFeaturesJson = (new SectionsFeaturesJsonCreator($event->subTypeId))->create();
         $assignedFeatures = new AssignedFeatures();
         $assignedFeatures->subTypeId = $event->subTypeId;
         $assignedFeatures->json = json_encode($assignedFeaturesJson);
         (new AssignedFeaturesJsonRepository())->store($assignedFeatures);
    }
}