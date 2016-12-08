<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\AddToFavouriteValidators;
use App\Http\Validators\Interfaces\ValidatorsInterface;

class DeleteToFavouritePropertyValidator extends FavouriteValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function CustomValidationMessages()
    {
        return [

        ];
    }
    public function rules()
    {
        return[
            'propertyId'=>'required|exists:favourite_properties,property_id',
            'userId'=>'required',
        ];
    }
}

