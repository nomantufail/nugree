<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyTypeValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class UpdatePropertyTypeValidator extends PropertyTypeValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'id' => 'required',
            'propertyType'=>'required|min:5|max:55',
        ];
    }
}

