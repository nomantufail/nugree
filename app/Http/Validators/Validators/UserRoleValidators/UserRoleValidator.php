<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:18 PM
 */

namespace App\Http\Validators\Validators\UserRoleValidators;

use App\Http\Validators\Validators\AppValidator;

class UserRoleValidator extends AppValidator
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

        ];
    }
}