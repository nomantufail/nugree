<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Role;

use App\DB\Providers\SQL\Models\Role;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\RoleValidators\UpdateRoleValidator;
use App\Http\Validators\Validators\UserRoleValidators\UpdateUserRoleValidator;
use App\Transformers\Request\Role\UpdateRoleTransformer;
use App\Transformers\Request\UserRole\UpdateUserRoleTransformer;

class UpdateRoleRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct()
    {
        parent::__construct(new UpdateRoleTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateRoleValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate()
    {
        return $this->validator->validate();
    }
    /**
     * @return Role::class
     * */
    public function getRoleModel()
    {
        $userRole = new Role();
        $userRole->id = $this->get('id');
        $userRole->name = $this->get('roleName');
        return $userRole;
    }
}