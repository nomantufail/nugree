<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\City\AddCityRequest;
use App\Http\Requests\Requests\City\DeleteCityRequest;
use App\Http\Requests\Requests\City\GetAllCitiesRequest;
use App\Http\Requests\Requests\City\GetCitiesByCountryRequest;
use App\Http\Requests\Requests\City\GetCitiesBySocietyRequest;
use App\Http\Requests\Requests\City\UpdateCityRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Transformers\Response\CityTransformer;

class CitiesController extends ApiController
{
    private $cities = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,CityTransformer $countryTransformer,
        CitiesRepoProvider $citiesRepository
    )
    {
        $this->cities =  $citiesRepository->repo();
        $this->response = $response;
    }
    public function store(AddCityRequest $request)
    {
        $city = $request->getCityModel();
        $city->id = $this->cities->store($city);
        return $this->response->respond(['data' => [
            'city' => $city
        ]]);
    }
    public function update(UpdateCityRequest $request)
    {
        $city =$request->getCityModel();
        $this->cities->update($city);
        return $this->response->respond(['data' => [
            'city' => $city
        ]]);
    }
    public function delete(DeleteCityRequest $request)
    {
        return $this->response->respond(['data'=>[
            'city'=>$this->cities->delete($request->getCityModel())
        ]]);
    }
    public function all(GetAllCitiesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'cities'=>$this->cities->all()
        ]]);
    }
    public function getByCountry(GetCitiesByCountryRequest $request)
    {
        return $this->response->respond(['data'=>[
            'city'=>$this->cities->getByCountry($request->get('countryId'))
        ]]);
    }
    public function getBySociety(GetCitiesBySocietyRequest $request)
    {
        return $this->response->respond(['data'=>[
               'city'=>$this->cities->getBySociety($request->get('societyId'))
        ]]);
    }

}
