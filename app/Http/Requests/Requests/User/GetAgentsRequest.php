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
use App\Http\Validators\Validators\UserValidators\SearchUsersValidator;
use App\Transformers\Request\User\SearchUsersTransformer;

class GetAgentsRequest extends Request implements RequestInterface{
    public $validator;
    public function __construct(){
        parent::__construct(new SearchUsersTransformer($this->getOriginalRequest()));
        $this->validator = new SearchUsersValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
}