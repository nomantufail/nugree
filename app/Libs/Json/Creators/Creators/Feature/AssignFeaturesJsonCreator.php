<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 9:19 AM
 */

namespace App\Libs\Json\Creators\Creators\Feature;


use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Feature\AssignFeaturesJsonPrototype;

class AssignFeaturesJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $subTypeId = 0;
    public $model;
    public function __construct($subTypeId)
    {
        $this->subTypeId = $subTypeId;
        $this->model = new AssignFeaturesJsonPrototype();
    }
    public function create()
    {
        $this->model->subTypeId = $this->subTypeId;
        $this->model->features = $this->getFeatures();
        return $this->model;
    }

    public function getFeatures()
    {
        return (new SectionsFeaturesJsonCreator($this->subTypeId))->create();
    }

}