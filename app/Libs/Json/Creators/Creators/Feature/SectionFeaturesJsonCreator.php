<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 2:56 PM
 */

namespace App\Libs\Json\Creators\Creators\Feature;


use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Feature\SectionFeaturesJsonPrototype;

class SectionFeaturesJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public $section = null;
    public $model = null;
    public function __construct($section)
    {
        $this->section = $section;
        $this->model = new SectionFeaturesJsonPrototype();
    }
    public function create()
    {
        $features  = $this->section->features;
        $this->model->priority = $this->section->priority;
        foreach($features as $feature) {
            $this->model->features[] = (new FeatureWithValidationRulesJsonCreator($feature))->create();
        }
        $this->model->sectionName = $this->section->name;
        return $this->model;
    }
}