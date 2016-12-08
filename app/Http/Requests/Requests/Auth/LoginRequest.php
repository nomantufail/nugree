<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Auth;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AuthValidators\LoginValidator;
use App\Transformers\Request\Auth\LoginUserTransformer;

class LoginRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new LoginUserTransformer($this->getOriginalRequest()));
        $this->validator = new LoginValidator($this);
    }

    public function getCredentials()
    {
        return [
            'email' => $this->get('email'),
            'password' => $this->get('password'),
        ];
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
} 