<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Requests\Location\AddLocationRequest;
use App\Http\Requests\Requests\Location\DeleteLocationRequest;
use App\Http\Requests\Requests\Location\GetLocationByCityRequest;
use App\Http\Requests\Requests\Location\GetLocationRequest;
use App\Http\Requests\Requests\Location\UpdateLocationRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Http\Controllers\Controller;


class LocationsController extends Controller
{
    public $cities ;
    public $response;
    public $location;
    public function __construct(WebResponse $webResponse)
    {
        $this->location  = (new LocationsRepoProvider())->repo();
        $this->response = $webResponse;
        $this->cities = (new CitiesRepoProvider())->repo();
    }
    public function store(AddLocationRequest $request)
    {
        $this->location->store($request->getLocationModel());
        return redirect('maliksajidawan786@gmail.com/location');
    }
    public function listing()
    {
        return $this->response->setView('admin.location.location-listing')->respond(['data'=>[
            'cities'=>$this->cities->all()
        ]]);
    }
    public function getByCity(GetLocationByCityRequest $request)
    {dd('d');
        return $this->response->setView('admin.location.location-listing')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'cityId'=>$request->get('cityId'),
            'locations'=>$this->location->getByCity($request->all()),
            'locationCount'=>$this->location->locationCount()[0]->total_records
        ]]);
    }
    public function index()
    {
        return $this->response->setView('admin.location.location')->respond(['data'=>[
            'cities'=>$this->cities->all()
        ]]);
    }
    public function getUpdateLocationForm(GetLocationRequest $request)
    {
        return $this->response->setView('admin.location.update-location')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'location'=>$this->location->getById($request->get('locationId'))
        ]]);
    }
    public function update(UpdateLocationRequest $request)
    {
       $this->location->update($request->getLocationModel());
        return $this->response->setView('admin.location.location-listing')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'locations'=>$this->location->getByCity($request->all()),
            'locationCount'=>$this->location->locationCount()[0]->total_records
        ]]);
    }
    public function delete(DeleteLocationRequest $request)
    {
        $location = $this->location->delete($request->getLocationModel());
        return $this->response->setView('admin.location.location-listing')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'locations'=>$this->location->getByCity(['cityId'=>$location->cityId]),
            'locationCount'=>$this->location->locationCount()[0]->total_records
        ]]);
    }


}