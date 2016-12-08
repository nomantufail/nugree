<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\CityValidators\AddCityValidator;
use App\Http\Validators\Validators\PropertyValidators\AddPropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\DeleteMultiplePropertiesValidator;
use App\Http\Validators\Validators\PropertyValidators\DeletePropertyValidator;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Transformers\Request\City\AddCityTransformer;
use App\Transformers\Request\Property\AddPropertyTransformer;
use App\Transformers\Request\Property\DeleteMultiplePropertiesTransformer;
use App\Transformers\Request\Property\DeletePropertyTransformer;

class DeleteMultiplePropertiesRequest extends Request implements RequestInterface{

    public $validator = null;

    public function __construct(){
        parent::__construct(new DeleteMultiplePropertiesTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteMultiplePropertiesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
}