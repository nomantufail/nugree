<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Location\GetLocationByCityRequest;
use App\Http\Requests\Requests\Location\SearchLocationRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\LocationsRepoProvider;


class LocationsController extends ApiController
{
    private $society ;
    public $response;
    public function __construct
    (
        LocationsRepoProvider $societiesRepository,
        ApiResponse $response
    )
    {
        $this->location  = (new LocationsRepoProvider())->repo();
        $this->response = $response;
    }

    public function search(SearchLocationRequest $request)
    {
        return $this->response->respond(['data'=>[
            'locations'=> $this->location->search($request->all())
        ]]);
    }
    public function getByCity(GetLocationByCityRequest $request)
    {
        return $this->response->respond(['data'=>[
         'location'=> $this->location->getLocationByCity($request->all())
    ]]);
    }
}