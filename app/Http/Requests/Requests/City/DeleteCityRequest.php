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
use App\Http\Validators\Validators\CityValidators\DeleteCityValidator;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Repositories\Sql\CitiesRepository;
use App\Transformers\Request\City\DeleteCityTransformer;

class DeleteCityRequest extends Request implements RequestInterface{

    public $validator = null;
    private $cities = null;
    public function __construct(){
        parent::__construct(new DeleteCityTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteCityValidator($this);
        $this->cities = (new CitiesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getCityModel()
    {
        return $this->cities->getById($this->get('id'));
    }

} 