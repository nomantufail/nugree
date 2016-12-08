<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\City\AddCityRequest;
use App\Http\Requests\Requests\City\DeleteCityRequest;
use App\Http\Requests\Requests\City\GetAllCitiesRequest;
use App\Http\Requests\Requests\City\GetCitiesByCountryRequest;
use App\Http\Requests\Requests\City\GetCitiesBySocietyRequest;
use App\Http\Requests\Requests\City\UpdateCityRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\CountriesRepoProvider;
use App\Transformers\Response\CityTransformer;

class CitiesController extends Controller
{
    private $cities = null;
    public $response = null;
    public $country = null;
    public function __construct
    (
        WebResponse $response,CityTransformer $countryTransformer,
        CitiesRepoProvider $citiesRepository
    )
    {
        $this->cities =  $citiesRepository->repo();
        $this->response = $response;
        $this->country = (new CountriesRepoProvider())->repo();
    }
    public function index()
    {
        return $this->response->setView('admin.city.city')->respond(['data'=>[
            'countries'=>$this->country->all(),
        ]]);
    }
    public function store(AddCityRequest $request)
    {
        $city = $request->getCityModel();
        $city->id = $this->cities->store($city);
        return redirect('maliksajidawan786@gmail.com/city');
    }

    public function update(UpdateCityRequest $request)
    {
        $city =$request->getCityModel();
        $this->cities->update($city);
        return redirect('maliksajidawan786@gmail.com/city/listing');
    }
    public function getCityUpdateForm(UpdateCityRequest $request)
    {
        return $this->response->setView('admin.city.update-city')->respond(['data'=>[
            'countries'=>$this->country->all(),
            'city'=>$this->cities->getById($request->get('id')),
        ]]);
    }
    public function delete(DeleteCityRequest $request)
    {
        $this->cities->delete($this->cities->getById($request->get('id')));
        return redirect('maliksajidawan786@gmail.com/city/listing');
    }
    public function getAllCities(GetAllCitiesRequest $request)
    {
        return $this->response->setView('admin.city.city-listing')->respond(['data'=>[
            'cities'=>$this->cities->getAllCities($request->all()),
            'citiesCount'=>($this->cities->citesCount()[0]->total_records),
        ]]);
    }
    public function all(GetAllCitiesRequest $request)
    {
        return $this->response->setView('')->respond(['data'=>[
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
