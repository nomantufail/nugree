<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertySubType;

use App\DB\Providers\SQL\Models\AssignFeature;
use App\DB\Providers\SQL\Models\PropertySubType;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertySubTypeValidators\AssignFeatureValidator;
use App\Transformers\Request\PropertySubType\AssignFeatureTransformer;

class AssignFeatureRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AssignFeatureTransformer($this->getOriginalRequest()));
        $this->validator = new AssignFeatureValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return AssignFeature::class
     * */
    public function assignFeatureModel()
    {
        $assignFeature = new AssignFeature();
        $assignFeature->featureId = $this->get('featureId');
        $assignFeature->propertySubTypeId = $this->get('propertySubTypeId');
        return $assignFeature;
    }

} 