<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\AgencyValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
class UpdateAgencyValidator extends AgencyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
                'id'=>'required',
                'userId'=>'required',
                'agencyName' => 'required|min:3|max:150',
                'companyMobile' => 'required|min:3|max:15',
                'companyPhone'=>'required|min:3|max:15',
                'companyAddress' =>'required|min:3|max:150',
                'companyEmail'=>'required|email|unique:agencies,email|min:3|max:255',

            ];
    }
}

