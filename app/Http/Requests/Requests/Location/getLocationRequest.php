<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Location;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LocationValidators\GetLocationsValidator;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Transformers\Request\Location\GetLocationTransformer;

class GetLocationRequest extends Request implements RequestInterface{

    public $validator = null;
    private $location = null;
    public function __construct(){
        parent::__construct(new GetLocationTransformer($this->getOriginalRequest()));
        $this->validator = new GetLocationsValidator($this);
        $this->location = (new LocationsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }
    public function getParams($location)
    {

        $params =  [
            'wanted' => 0,
            'purposeId' =>null,
            'propertyTypeId' => null,
            'subTypeId' => null,
            'societyId' => null,
            'cityId'=> null,
            'locationId'=>$location->id,
            'blockId' => null,
            'bedrooms' => null,
            'priceFrom' => null,
            'priceTo' => null,
            'landUnitId' => null,
            'landAreaFrom' => null,
            'landAreaTo' => null,
            'propertyFeatures' => null,
            'page' =>null,
            'limit' => null,
            'sortBy' =>null,
            'order' => null,
        ];
        $params['locationId'] = ($params['locationId'] != "" && $params['locationId'] != null)?explode(',',$params['locationId']):null;
        return $params;
    }
    public function validate(){
        return $this->validator->validate();
    }

    public function getLocationModel()
    {
        return $this->location->getById($this->get('id'));
    }

} 