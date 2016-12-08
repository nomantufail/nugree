<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\DB\Providers\SQL\Models\Agency;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\ChangePasswordValidator;
use App\Http\Validators\Validators\UserValidators\UpdateUserValidator;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\User\ChangePasswordTransformer;
use App\Transformers\Request\User\UpdateUserTransformer;

class ChangePasswordRequest extends Request implements RequestInterface
{

    public $validator;
    private $users;
    public function __construct(){
        parent::__construct(new ChangePasswordTransformer($this->getOriginalRequest()));
        $this->validator = new ChangePasswordValidator($this);

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