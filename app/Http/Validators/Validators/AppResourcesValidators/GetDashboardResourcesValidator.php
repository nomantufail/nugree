<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\AppResourcesValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;

class GetDashboardResourcesValidator extends AppsResourcesValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'userId' => 'required',
        ];
    }
}

