<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models\Features;

use App\DB\Providers\SQL\Models\ValidationRules\ValidationRuleWithErrorMessage;

class FeatureWithValidationRules {

    public $featureId = 0;
    public $featureName;
    public $featureInputName;
    public $section;
    /* array ValidationRuleWithErrorMessage::class */
    public $validationRules = [];

    public $priority = 0;
    public $assignedSubTypeId = 0;
    public $htmlStructure = null;
    public $possibleValues = "";
    public function __construct(){}


    /**
     * @return array
     */
    public function rules()
    {
        $featureRules = [];
        foreach($this->validationRules as $rule /* @var $rule ValidationRuleWithErrorMessage::class*/)
        {
            $featureRules[] = $rule->name;
        }
        return $featureRules;
    }


    /**
     * @return string
     */
    public function rulesToString()
    {
        $featureRules = [];
        foreach($this->validationRules as $rule /* @var $rule ValidationRuleWithErrorMessage::class*/)
        {
            $featureRules[] = $rule->name;
        }
        return join('|',$featureRules);
    }

    public function customErrorMessages()
    {
        $customMessages = [];
        foreach($this->validationRules as $rule /* @var $rule ValidationRuleWithErrorMessage::class*/)
        {
            if($rule->errorMessage != null)
            {
                $customMessages[$this->featureInputName.'.'.$rule->name] = $this->featureName.' '.$rule->errorMessage->longMessage;
            }
        }
        return $customMessages;
    }
} 

