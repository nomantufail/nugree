<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyStatus;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;

use App\Http\Validators\Validators\PropertyStatusValidators\GetAllPropertyStatusValidator;
use App\Transformers\Request\PropertyStatus\GetAllPropertyStatusTransformer;

class GetAllPropertyStatusRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllPropertyStatusTransformer($this->getOriginalRequest()));
        $this->validator = new GetAllPropertyStatusValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 