<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\Features\PropertyFeatureValueAndSection;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyFeatureJsonPrototype;

class PropertyFeatureJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyFeatureValueAndSection $feature = null)
    {
        $this->model = $feature;
        $this->prototype = new PropertyFeatureJsonPrototype();
    }

    public function create()
    {
        $model = clone($this->model);
        $this->prototype->id = $model->featureId;
        $this->prototype->name = $model->featureName;
        $this->prototype->inputName = $model->featureInputName;
        $this->prototype->value = $model->value;
        $this->prototype->priority = $model->priority;
        $this->prototype->htmlStructure = $model->htmlStructure;
        return $this->prototype;
    }

}