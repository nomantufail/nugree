<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\GetAgentValidator;
use App\Transformers\Request\User\GetAgentTransformer;
class GetAgentRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetAgentTransformer($this->getOriginalRequest()));
        $this->validator = new GetAgentValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 