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
use App\Http\Validators\Validators\UserRoleValidators\GetAllUserRolesValidator;
use App\Transformers\Request\UserRole\GetAllUserRolesTransformer;

class GetAllUserRolesRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllUserRolesTransformer($this->getOriginalRequest()));
        $this->validator = new GetAllUserRolesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 