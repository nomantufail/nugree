<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 10:00 AM
 */

namespace App\Http\Validators\Validators\FeatureValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class DeleteFeatureValidator extends FeatureValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function CustomValidationMessages()
    {
        return [];
    }
    public function rules()
    {
        return[
            'featureId'=>'required',

        ];
    }
}