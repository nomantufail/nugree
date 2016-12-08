<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Role;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\RoleValidators\DeleteRoleValidator;
use App\Http\Validators\Validators\UserRoleValidators\DeleteUserRoleValidator;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\UserRolesRepoProvider;
use App\Transformers\Request\Role\DeleteRoleTransformer;
use App\Transformers\Request\UserRole\DeleteUserRoleTransformer;

class DeleteRoleRequest extends Request implements RequestInterface{

    public $validator = null;
    private $roles = null;
    public function __construct(){
        parent::__construct(new DeleteRoleTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteRoleValidator($this);
        $this->roles = (new RolesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getRoleModel()
    {
        return $this->roles->getRoleById($this->get('id'));
    }

} 