<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/13/2016
 * Time: 5:40 PM
 */

namespace App\Libs\Json\Creators\Creators\Feature;


use App\DB\Providers\SQL\Models\Features\FeatureWithValidationRules;
use App\DB\Providers\SQL\Models\ValidationRules\ValidationRuleWithErrorMessage;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Feature\FeatureWithValidationRulesJsonPrototype;

class FeatureWithValidationRulesJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public $feature = null;
    public $model = null;
    public function __construct(FeatureWithValidationRules  $feature)
    {
        $this->feature = $feature;
        $this->model = new FeatureWithValidationRulesJsonPrototype();
    }

    public function create()
    {
        $this->model->id = $this->feature->featureId;
        $this->model->name = $this->feature->featureName;
        $this->model->htmlStructure = $this->feature->htmlStructure;
        $this->model->priority = $this->feature->priority;
        $this->model->possibleValues = $this->feature->possibleValues;

        foreach($this->feature->validationRules as $validationRule /* @var  $validationRule ValidationRuleWithErrorMessage */) {

            $this->model->validationRules[$validationRule->name] = (new ValidationRuleErrorMessageJsonCreator($validationRule->errorMessage))->create();
        }
        return $this->model;
    }
}