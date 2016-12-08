<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\LandUnit\UpdateLandUnitRequest;
use App\Http\Requests\Requests\LandUnit\AddLandUnitRequest;
use App\Http\Requests\Requests\LandUnit\DeleteLandUnitRequest;
use App\Http\Requests\Requests\LandUnit\GetAllLandUnitsRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;


class LandUnitController extends ApiController
{
    private $LandUnit = null;
    public $response = null;

    public function __construct
    (
        LandUnitsRepoProvider $landUnitRepository,
        ApiResponse $response
    )
    {
        $this->LandUnit  = $landUnitRepository->repo();
        $this->response = $response;
    }
    public function store(AddLandUnitRequest $request)
    {
        $landUnit = $request->getLandUnitModel();
        $landUnitId = $this->LandUnit->store($landUnit);
        $landUnit->id = $landUnitId;
        return $this->response->respond(['data'=>[
            'landUnit' => $landUnit
        ]]);
    }

    public function update(UpdateLandUnitRequest $request)
    {
        $landUnit = $request->getLandUnitModel();
        $this->LandUnit->update($landUnit);
        return $this->response->respond(['data'=>[
        'landUnit'=>$landUnit
        ]]);
    }
    public function all(GetAllLandUnitsRequest $request)
    {
        return $this->response->respond(['data'=>[
            'landUnit'=>$this->LandUnit->all()
        ]]);
    }
    public function delete(DeleteLandUnitRequest $request)
    {
        return $this->response->respond(['data'=>[
            'landUnit'=>$this->LandUnit->delete($request->getLandUnitModel())
        ]]);
    }

}