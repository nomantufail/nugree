<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits\Property;

use App\Libs\File\FileRelease;
use App\Libs\Json\Prototypes\Prototypes\Property\Owner\PropertyAgencyJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyDocumentJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Traits\AppTrait;

trait ShowAddPropertyFormHelper
{
    use AppTrait;

    public function transformAddPropertyFormFeatures($assignedFeatures)
    {
        return collect($assignedFeatures)
            ->each(function($item, $key) {
                $heighPriorityFeatures = [];
                $item->features = collect($item->features)->each(function($section, $key) use (&$heighPriorityFeatures) {
                    foreach($section->features as $featureKey => $feature){
                        if($feature->priority == 1){
                            unset($section->features[$featureKey]);
                            $heighPriorityFeatures[] = $feature;
                        }
                    }
                    $section->totalFeatures = count($section->features);
                })->sortBy('totalFeatures')->toArray();
                $item->priorityFeatures = $heighPriorityFeatures;
            })->toArray();
    }
}