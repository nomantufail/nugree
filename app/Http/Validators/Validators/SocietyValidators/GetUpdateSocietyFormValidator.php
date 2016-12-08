<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\SocietyValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Http\Validators\Validators\SocietyValidators\SocietyValidator;

class GetUpdateSocietyFormValidator extends SocietyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'societyId' => 'required',

        ];
    }
}

