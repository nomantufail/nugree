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
use App\Http\Validators\Validators\UserValidators\ForgetPasswordValidator;
use App\Transformers\Request\User\ForgetPasswordTransformer;
use App\Transformers\Request\User\GetUsersTransformer;

class ForgetPasswordRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new ForgetPasswordTransformer($this->getOriginalRequest()));
        $this->validator = new  ForgetPasswordValidator($this);
    }
    public function authorize()
    {}
    public function validate()
    {
        return $this->validator->validate();
    }
} 