<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/3/2016
 * Time: 3:57 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class GetUserPropertiesValidator extends PropertyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function rules()
    {
        return [
            'purposeId'=>'numeric|min:0',
            'userId'=>'numeric|min:0',
            'statusId'=>'numeric|min:0',
            'limit'=>'numeric|min:0',
            'start'=>'numeric|min:0',
         ];
    }
}