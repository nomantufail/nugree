<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Country\AddCountryRequest;
use App\Http\Requests\Requests\Country\DeleteCountryRequest;
use App\Http\Requests\Requests\Country\GetAllCountriesRequest;
use App\Http\Requests\Requests\Country\UpdateCountryRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\CountriesRepoProvider;
use App\Transformers\Response\CountryTransformer;

class CountriesController extends ApiController
{
    private $countries = null;
    private $userTransformer = null;
    public $response = null;
    public function __construct
    (ApiResponse $response,CountryTransformer $countryTransformer,
     CountriesRepoProvider $countriesRepository )
    {
        $this->countries =  $countriesRepository->repo();
        $this->userTransformer = $countryTransformer;
        $this->response = $response;
    }
    public function store(AddCountryRequest $request)
    {
        $country =$request->getCountryModel();
        $country->id = $this->countries->store($country);
        return $this->response->respond(['data'=>['country' =>$country]]);
    }
    public function update(UpdateCountryRequest $request)
    {
        $country =$request->getCountryModel();
        $this->countries->store($country);
        return $this->response->respond(['data'=>['country' =>$country]]);
    }
    public function delete(DeleteCountryRequest $request)
    {
        return $this->response->respond(['data'=>[
            'country'=>$this->countries->delete($request->getCountryModel())
        ]]);
    }
    public function all(GetAllCountriesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'countries'=>$this->countries->all()
        ]]);
    }
}
