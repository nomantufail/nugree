<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyStatusValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class UpdatePropertyStatusValidator extends PropertyStatusValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'id' => 'required',
            'propertyStatus'=>'required|min:5|max:55',
        ];
    }
}

