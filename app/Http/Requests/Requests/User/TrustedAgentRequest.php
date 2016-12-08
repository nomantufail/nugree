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
use App\Http\Validators\Validators\UserValidators\TrustedAgentValidator;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\User\AddUserTransformer;
use App\Transformers\Request\User\TrustedAgentTransformer;

class TrustedAgentRequest extends Request implements RequestInterface{

    public $validator;
    private $users =null;
    public function __construct(){
        parent::__construct(new TrustedAgentTransformer($this->getOriginalRequest()));
        $this->validator = new TrustedAgentValidator($this);
        $this->users = (new UsersRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getUserModel()
    {
        return $this->users->getById($this->get('userId'));
    }
}