<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;

class PropertyFeaturesJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $features = null;
    public function __construct(array $propertyFeatures = null)
    {
        $this->features = $propertyFeatures;
    }

    public function create()
    {
        $finalFeaturesJson = [];
        $collection = collect($this->features);
        $grouped = $collection->each(function ($feature, $key) {
            $feature->sectionName = $feature->section->name;
        })->groupBy('sectionName');
        foreach($grouped as $sectionName => $group)
        {
            $sectionFeatures = [];
            foreach($group as $feature)
            {
                $sectionFeatures[] = (new PropertyFeatureJsonCreator($feature))->create();
            }
            $finalFeaturesJson[$sectionName] = $sectionFeatures;
        }
        return $finalFeaturesJson;
    }

}