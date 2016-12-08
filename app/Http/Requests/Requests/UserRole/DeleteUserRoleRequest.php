<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\UserRole;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserRoleValidators\DeleteUserRoleValidator;
use App\Repositories\Providers\Providers\UserRolesRepoProvider;
use App\Transformers\Request\UserRole\DeleteUserRoleTransformer;

class DeleteUserRoleRequest extends Request implements RequestInterface{

    public $validator = null;
    private $userRoles = null;
    public function __construct(){
        parent::__construct(new DeleteUserRoleTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteUserRoleValidator($this);
        $this->userRoles = (new UserRolesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getUserRoleModel()
    {
        return $this->userRoles->getById($this->get('id'));
    }

} 