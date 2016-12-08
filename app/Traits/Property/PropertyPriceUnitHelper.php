<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits\Property;

use App\DB\Providers\SQL\Models\Property;
use App\Libs\Helpers\LandArea;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Traits\AppTrait;

trait PropertyPriceUnitHelper
{
    use AppTrait;

    public function convertPropertyAreaToLowestUnit(Property $property)
    {
        $property->landArea = LandArea::convert(config('constants.LAND_UNITS')[$property->landUnitId], 'square feet', $property->landArea);
        return $property;
    }

    public function convertPropertiesAreaToActualUnit(array $properties)
    {
        foreach($properties as &$property){
            $property = $this->convertPropertyAreaToActualUnit($property);
        }
        return $properties;
    }
    public function convertPropertyAreaToActualUnit(PropertyJsonPrototype $property)
    {
        $property->land->area = LandArea::convert('square feet',$property->land->unit->name, $property->land->area);
        return $property;
    }
}