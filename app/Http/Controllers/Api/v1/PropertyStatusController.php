<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertyStatus\UpdatePropertyStatusRequest;
use App\Http\Requests\Requests\PropertyStatus\AddPropertyStatusRequest;
use App\Http\Requests\Requests\PropertyStatus\DeletePropertyStatusRequest;
use App\Http\Requests\Requests\PropertyStatus\GetAllPropertyStatusRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;

class PropertyStatusController extends ApiController

{
    private $PropertyStatus = null;
    public $response = null;

    public function __construct
    (
        PropertyStatusesRepoProvider $propertyStatusRepository,
        ApiResponse $response
    )
    {
        $this->PropertyStatus  = $propertyStatusRepository->repo() ;
        $this->response = $response;
    }
    public function store(AddPropertyStatusRequest $request)
    {
        $landUnit = $request->getPropertyStatusModel();
        $landUnitId = $this->PropertyStatus->store($landUnit);
        $landUnit->id = $landUnitId;
        return $this->response->respond(['data'=>[
            'propertyStatus' => $landUnit
        ]]);
    }

    public function update(UpdatePropertyStatusRequest $request)
    {
        $propertyStatus = $request->getPropertyStatusModel();
        $this->PropertyStatus->update($propertyStatus);
        return $this->response->respond(['data'=>[
        'propertyStatus'=>$propertyStatus
        ]]);
    }
    public function all(GetAllPropertyStatusRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyStatus'=>$this->PropertyStatus->all()
        ]]);
    }
    public function delete(DeletePropertyStatusRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyStatus'=>$this->PropertyStatus->delete($request->getPropertyStatusModel())
        ]]);
    }

}