<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class SearchUsersValidator extends UserValidator implements ValidatorsInterface
{

    public function __construct($request){
        parent::__construct($request);
    }

    public function userRules()
    {
        return [
            'userRole'=>'required'
        ];
    }

}