<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\Requests\PropertyPurposes\AddPropertyPurposeRequest;
use App\Http\Requests\Requests\PropertyPurposes\DeletePropertyPurposeRequest;
use App\Http\Requests\Requests\PropertyPurposes\GetAllPropertyPurposesRequest;
use App\Http\Requests\Requests\PropertyPurposes\UpdatePropertyPurposeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\PropertyPurposesRepoProvider;


class PropertyPurposeController extends ApiController
{
    private $propertyPurposeRepository = null;
    public $response = null;
    public function __construct
    (
        PropertyPurposesRepoProvider $propertyPurposeRepository,
        ApiResponse $response
    )
    {
        $this->propertyPurposeRepository  = $propertyPurposeRepository->repo();
        $this->response = $response;
    }
    public function store(AddPropertyPurposeRequest $request)
    {
        $propertyPurpose =$request->getPropertyPurposeModel();
        $propertyPurposeId = $this->propertyPurposeRepository->store($propertyPurpose);
        $propertyPurpose->id = $propertyPurposeId;
        return $this->response->respond(['data'=>['PropertyPurpose' =>$propertyPurpose]]);
    }

    public function all(GetAllPropertyPurposesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyPurpose'=>$this->propertyPurposeRepository->all()
        ]]);
    }
    public function delete(DeletePropertyPurposeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyPurpose'=>$this->propertyPurposeRepository->delete($request->getPropertyPurposeModel())
        ]]);
    }
    public function update(UpdatePropertyPurposeRequest $request)
    {
        $propertyPurpose =$request->getPropertyPurposeModel();
        $this->propertyPurposeRepository->store($propertyPurpose);
        return $this->response->respond(['data'=>['propertyPurpose' =>$propertyPurpose]]);

    }
}