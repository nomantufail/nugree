<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyDocumentValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class AddPropertyDocumentValidator extends PropertyDocumentValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'propertyId' => 'required',
            'path'=>'required|min:5|max:30',
            'title' => 'required|min:5|max:55',
            'type'=>'required|min:5|max:55'
        ];
    }
}

