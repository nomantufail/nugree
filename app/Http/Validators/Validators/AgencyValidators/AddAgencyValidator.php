<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\AgencyValidators;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class AddAgencyValidator extends AgencyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function CustomValidationMessages()
    {
        return [
            'agencyName.required' => 'Agency name is required',
            'companyPhone.required' => 'Company phone is required',
            'companyAddress.required' => 'Company address is required',
            'companyEmail.required' => 'Company email is required',
            'companyMobile.required'=>'Company Mobile is required'
        ] ;
    }
    public function rules()
    {
        return[

            'userId'=>'required',
            'agencyName' =>'required|unique:agencies,agency|max:255',
            'companyMobile' =>'required|max:15',
            'companyPhone'=>'required|max:15',
            'companyAddress' => 'required|max:225',
            'companyEmail'=>'required|email|unique:agencies,email|max:255',

        ];
    }
}

