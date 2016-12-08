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
use App\Http\Validators\Validators\PropertyValidators\DeletePropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\ForceDeletePropertyValidator;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Transformers\Request\City\AddCityTransformer;
use App\Transformers\Request\Property\AddPropertyTransformer;
use App\Transformers\Request\Property\DeletePropertyTransformer;
use App\Transformers\Request\Property\ForceDeletePropertyTransformer;

class ForceDeletePropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    private $properties = null;

    public function __construct(){
        parent::__construct(new ForceDeletePropertyTransformer($this->getOriginalRequest()));
        $this->validator = new ForceDeletePropertyValidator($this);
        $this->properties = (new PropertiesRepoProvider())->repo();
    }
    /**
     * @return Property|null
     */
    public function getPropertyModel()
    {
        return $this->properties->getById($this->get('propertyId'));
    }
    public function authorize()
    {
        if($this->user()->can('forceDelete','property',$this->getPropertyModel())){
            return true;
        }
        return false;
    }
   public function validate(){
        return $this->validator->validate();
    }
}