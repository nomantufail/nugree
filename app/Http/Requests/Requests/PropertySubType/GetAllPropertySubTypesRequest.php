<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertySubType;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertySubTypeValidators\GetAllPropertySubTypesValidator;
use App\Transformers\Request\PropertySubType\GetAllPropertySubTypesTransformer;

class GetAllPropertySubTypesRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllPropertySubTypesTransformer($this->getOriginalRequest()));
        $this->validator = new GetAllPropertySubTypesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 