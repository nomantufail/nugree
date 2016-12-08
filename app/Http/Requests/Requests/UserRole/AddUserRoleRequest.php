<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\UserRole;

use App\DB\Providers\SQL\Models\UserRole;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserRoleValidators\AddUserRoleValidator;
use App\Transformers\Request\UserRole\AddUserRoleTransformer;

class AddUserRoleRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
       parent::__construct(new AddUserRoleTransformer($this->getOriginalRequest()));
       $this->validator = new AddUserRoleValidator($this);
    }

    public function authorize(){
        return true;
    }
    public function validate()
    {
        return $this->validator->validate();
    }

    /**
     * @return UserRole::class
     * */
    public function getUserRoleModel()
    {
        $userRole = new UserRole();
        $userRole->userId = $this->get('userId');
        $userRole->roleId = $this->get('roleId');
        return $userRole;
    }
}