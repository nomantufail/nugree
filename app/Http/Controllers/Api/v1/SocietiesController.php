<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\City\GetCitiesBySocietyRequest;
use App\Http\Requests\Requests\Society\AddSocietyRequest;
use App\Http\Requests\Requests\Society\DeleteSocietyRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesRequest;
use App\Http\Requests\Requests\Society\GetSocietiesByCityRequest;
use App\Http\Requests\Requests\Society\UpdateSocietyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;

class SocietiesController extends ApiController
{
    private $society ;
    public $response;
    public function __construct
    (
        SocietiesRepoProvider $societiesRepository,
        ApiResponse $response
    )
    {
        $this->society  = $societiesRepository->repo();
        $this->response = $response;
    }
    public function store(AddSocietyRequest $request)
    {
        $society = $request->getSocietyModel();
        $societyId = $this->society->store($society);
        $society->id = $societyId;
        return $this->response->respond(['data'=>[
            'society'=>$society
        ]]);
    }

    public function all(GetAllSocietiesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'societies'=>$this->society->all()
        ]]);
    }

    public function delete(DeleteSocietyRequest $request)
    {
        return $this->response->respond(['data'=>[
            'society'=>$this->society->delete($request->getSocietyModel())
        ]]);
    }

    public function update(UpdateSocietyRequest $request)
    {
        $society = $request->getSocietyModel();
        $this->society->update($society);
        return $this->response->respond(['data'=>[
            'society'=>$society
        ]]);
    }

    public function getByCity(GetSocietiesByCityRequest $request)
    {
        return $this->response->respond(['data'=>[
         'societies'=> $this->society->getByCity($request->get('cityId'))
    ]]);
    }
}