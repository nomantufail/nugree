<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 11:13 AM
 */

namespace App\Http\Validators\Validators\CountryValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class AllCountriesValidators extends CountryValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }

    /**
     * @return array
     */
    public function rules()
    {
       return [

       ];
    }
}