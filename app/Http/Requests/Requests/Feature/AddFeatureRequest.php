<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 9:39 AM
 */

namespace App\Http\Requests\Requests\Feature;


use App\DB\Providers\SQL\Models\Features\Feature;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\FeatureValidators\AddFeatureValidator;
use App\Transformers\Request\Feature\AddFeatureTransformer;

class AddFeatureRequest extends Request implements RequestInterface
{
    public $validator = null;
    public function __construct()
    {
        parent::__construct(new AddFeatureTransformer($this->getOriginalRequest()));
        $this->validator = new AddFeatureValidator($this);
    }
    public function authorize(){}
    public function validate()
    {
       return $this->validator->validate();
    }
    public function GetFeatureModel()
    {
        $feature = new Feature();
        $feature->featureSectionId = $this->get('featureSectionId');
        $feature->name = $this->get('featureName');
        $feature->inputName = $this->get('featureInputName');
        $feature->htmlStructureId = $this->get('featureHtmlStructureId');
        $feature->possibleValues = $this->get('featurePossibleValues');
        $feature->priority = $this->get('featurePriority');
        return $feature;
    }
}