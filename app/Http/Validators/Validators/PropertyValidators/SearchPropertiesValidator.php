<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;


use App\DB\Providers\SQL\Models\Features\FeatureWithValidationRules;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class SearchPropertiesValidator extends PropertyValidator implements ValidatorsInterface
{
    public function rules()
    {
        return [

        ];
    }
}

