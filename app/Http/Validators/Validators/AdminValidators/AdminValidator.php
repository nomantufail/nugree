<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:18 PM
 */

namespace App\Http\Validators\Validators\AdminValidators;

use App\Http\Validators\Validators\AppValidator;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use Illuminate\Support\Facades\Validator;

class AdminValidator extends AppValidator
{
    protected $extraFeatures = null;
    protected $featuresRepository = null;
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