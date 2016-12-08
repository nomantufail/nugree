<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 11:12 AM
 */

namespace App\Http\Validators\Validators\CountryValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class UpdateCountryValidator extends CountryValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'id'=>'required',
            'country'=>'required|min:5|max:25'
        ];
    }
}