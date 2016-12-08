<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
class deActivePropertyValidator extends PropertyValidator implements ValidatorsInterface
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
            'propertyId'=>'required',
        ];
    }

}

