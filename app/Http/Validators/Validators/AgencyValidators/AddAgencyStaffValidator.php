<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\AgencyValidators;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class AddAgencyStaffValidator extends AgencyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function CustomValidationMessages()
    {
        return [
            'firstName.required' => 'First Name is required',
            'lastName.required' => 'First Name is required',
            'email.required' => 'Email is required',
            'mobile.required' => 'Mobile is required',
            'password.required'=>'Password is required',
            'conformPassword.required'=>'Conform Password is required',
        ] ;
    }
    public function rules()
    {
        return[
            'firstName'=> 'required|min:3|max:150',
            'lastName'=> 'required|min:3|max:150',
            'email'=>'required|email|max:255',
            'mobile'=> 'required|min:3|max:15',
            'password'=> 'required|min:3|max:15',

        ];
    }
}

