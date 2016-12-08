<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;

class ForceDeleteMultiplePropertiesValidator extends PropertyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return [
            'propertyIds'=>'required',
        ];
    }
}

