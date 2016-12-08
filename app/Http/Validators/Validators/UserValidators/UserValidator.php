<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Http\Validators\Validators\AppValidator;
use Illuminate\Support\Facades\Validator;
class UserValidator extends AppValidator
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

    public function registerImageExtensionRule()
    {
        Validator::extend('image_validation', function($attribute, $value, $parameters)
        {
            try {
                $companyLogo = $this->request->get('companyLogo');
                $logo = false;
                $logoExtension = $companyLogo->getClientOriginalExtension();
                if(strtolower($logoExtension) =='jpg' ||strtolower($logoExtension) =='jpeg' ||strtolower($logoExtension) =='png')
                {
                    $logo = true;
                }
                if(!$logo)
                {
                    return false;
                }
            }catch(\Exception $e)
            {
                throw $e;
            }
            return true;
        });
    }
}