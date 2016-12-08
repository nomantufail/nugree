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
use App\Http\Validators\Validators\RoleValidators\AddRoleValidator;
use App\Transformers\Request\Role\AddRoleTransformer;

class AddRoleRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
       parent::__construct(new AddRoleTransformer($this->getOriginalRequest()));
       $this->validator = new AddRoleValidator($this);
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
        $role = new Role();
        $role->name = $this->get('roleName');
        return $role;
    }
}