<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\City;


use App\DB\Providers\SQL\Models\City;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\CityValidators\AddCityValidator;
use App\Transformers\Request\City\AddCityTransformer;

class AddCityRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddCityTransformer($this->getOriginalRequest()));
        $this->validator = new AddCityValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return City::class
     * */
    public function getCityModel()
    {
        $city = new City();
        $city->name = $this->get('name');
        $city->countryId = $this->get('countryId');
        $city->priority = $this->get('priority');
        $city->path = $this->getCityImage();
        return $city;
    }
    public function getCityImage()
    {
        $originalName = $this->get('file');
        if(isset($originalName)) {
            $extension = $originalName->getClientOriginalExtension();
            $imageName = md5($originalName->getClientOriginalName()) . '.' . $extension;
            $originalName->move(public_path() . '/assets/imgs/42_ads', $imageName);
            return 'assets/imgs/42_ads/' . $imageName;
        }
        return '';
    }

} 