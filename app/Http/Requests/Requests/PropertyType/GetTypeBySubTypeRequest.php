<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyType;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyTYpeValidators\GetTypeBySubTypeValidator;
use App\Transformers\Request\PropertyType\GetTypeBySubTypeTransformer;

class GetTypeBySubTypeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct()
    {
        parent::__construct(new GetTypeBySubTypeTransformer($this->getOriginalRequest()));
        $this->validator = new GetTypeBySubTypeValidator($this);
    }

    public function authorize()
    {
        return true;
    }

    public function validate()
    {
        return $this->validator->validate();
    }
}