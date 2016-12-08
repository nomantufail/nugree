<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\DB\Providers\SQL\Models\Property;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyValidators\ApprovePropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\GetAdminPropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\GetPropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\RejectPropertyValidator;
use App\Http\Validators\Validators\UserValidators\ApproveAgentValidator;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\Property\ApprovePropertyTransformer;
use App\Transformers\Request\Property\GetAdminPropertyTransformer;
use App\Transformers\Request\Property\GetPropertyTransformer;
use App\Transformers\Request\Property\RejectPropertyTransformer;
use App\Transformers\Request\User\ApproveAgentTransformer;


class ApproveAgentRequest extends Request implements RequestInterface{

    public $validator = null;
    public $user = null;

    public function __construct(){
        parent::__construct(new ApproveAgentTransformer($this->getOriginalRequest()));
        $this->validator = new ApproveAgentValidator($this);
        $this->user = (new UsersRepoProvider())->repo();
    }

    /**
     * @return \App\DB\Providers\SQL\Models\User
     */
    public function getUserModel()
    {
        return $this->user->getById($this->get('userId'));
    }
    public function authorize(){

        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
}