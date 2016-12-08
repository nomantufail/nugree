<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\FeatureSection;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;

use App\Http\Validators\Validators\FeatureSectionValidators\GetAllFeatureSectionValidator;
use App\Transformers\Request\FeatureSection\GetAllFeatureSectionTransformer;

class GetAllFeatureSectionRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllFeatureSectionTransformer($this->getOriginalRequest()));
        $this->validator = new GetAllFeatureSectionValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 