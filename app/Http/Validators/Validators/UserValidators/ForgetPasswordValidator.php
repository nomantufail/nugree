<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Requests\User\GetUserRequest;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class ForgetPasswordValidator extends UserValidator implements ValidatorsInterface
{

    public function __construct($request){
        parent::__construct($request);
        $this->request = $request;
    }
    public function CustomValidationMessages(){
        return [

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
           'email'=>'required|exists:users,email'
        ];
    }
}