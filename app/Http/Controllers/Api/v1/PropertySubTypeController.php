<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertySubType\AssignFeatureRequest;
use App\Http\Requests\Requests\PropertySubType\GetSubTypesByTypeRequest;
use App\Http\Requests\Requests\PropertySubType\AddPropertySubTypeRequest;
use App\Http\Requests\Requests\PropertySubType\DeletePropertySubTypeRequest;
use App\Http\Requests\Requests\PropertySubType\GetAllPropertySubTypesRequest;
use App\Http\Requests\Requests\PropertySubType\UpdatePropertySubTypeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\AssignFeatureRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;

class PropertySubTypeController extends ApiController
{
    private $propertySubTypes = null;
    public $assignFeature = null;
    public $response = null;

    public function __construct
    (
        PropertySubTypesRepoProvider $propertySubTypeRepository,
        AssignFeatureRepoProvider $assignFeatureRepoProvider,
        ApiResponse $response
    )
    {
        $this->assignFeature = $assignFeatureRepoProvider->repo();
        $this->propertySubTypes  = $propertySubTypeRepository->repo();
        $this->response = $response;
    }
    public function store(AddPropertySubTypeRequest $request)
    {
        $subType = $request->getPropertySubTypeModel();
        $subTypeId = $this->propertySubTypes->store($subType);
        $subType->id = $subTypeId;
        return $this->response->respond(['data'=>[
            'propertySubType' => $subType
        ]]);
    }

    public function update(UpdatePropertySubTypeRequest $request)
    {
        $subType = $request->getPropertySubTypeModel();
        $this->propertySubTypes->update($subType);
        return $this->response->respond(['data'=>[
        'propertySubType'=>$subType
        ]]);
    }
    public function all(GetAllPropertySubTypesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertySubTypes'=>$this->propertySubTypes->all()
        ]]);
    }
    public function delete(DeletePropertySubTypeRequest $request)
    {
        return $this->response->respond(['propertySubType'=>[
            'propertySubType'=>$this->propertySubTypes->delete($request->getPropertySubTypeModel())
        ]]);
    }

    public function getByType(GetSubTypesByTypeRequest $request)
    {
        return $this->response->respond([
            'data'=>['propertySubType'=>$this->propertySubTypes->getByType($request->get('typeId'))
        ]]);

    }
    public function assignFeature(AssignFeatureRequest $request)
    {
        $assignFeature = $request->assignFeatureModel();
        $assignFeature->id = $this->assignFeature->store($assignFeature);
        return $this->response->respond(['data'=>['assignFeature'=>$assignFeature
        ]]);
    }
}