<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\AuthValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Http\Validators\Validators\AppValidator;


class AdminLoginValidator extends AppValidator implements ValidatorsInterface
{
    public function __construct($request){
        parent::__construct($request);
    }
    public function CustomValidationMessages(){
        return [
            //
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|min:5|max:255',
            'password' => 'required|min:3|max:20',
        ];
    }
}