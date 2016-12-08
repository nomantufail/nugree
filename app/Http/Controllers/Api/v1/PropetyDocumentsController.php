<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertyDocument\AddPropertyDocumentRequest;
use App\Http\Requests\Requests\PropertyDocument\DeletePropertyDocumentRequest;
use App\Http\Requests\Requests\PropertyDocument\GetAllPropertyDocumentsRequest;
use App\Http\Requests\Requests\PropertyDocument\UpdatePropertyDocumentRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\PropertyDocumentsRepoProvider;

class PropertyDocumentsController extends ApiController
{
    private $propertyDocument = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,
        PropertyDocumentsRepoProvider $PropertyDocumentRepository
    )
    {
        $this->propertyDocument =  $PropertyDocumentRepository->repo();
        $this->response = $response;
    }
    public function store(AddPropertyDocumentRequest $request)
    {
        $city = $request->getPropertyDocumentModel();
        $city->id = $this->propertyDocument->store($city);
        return $this->response->respond(['data' => [
            'propertyDocument' => $city
        ]]);
    }
    public function update(UpdatePropertyDocumentRequest $request)
    {
        $city =$request->getPropertyDocumentModel();
        $this->propertyDocument->update($city);
        return $this->response->respond(['data' => [
            'propertyDocument' => $city
        ]]);
    }
    public function delete(DeletePropertyDocumentRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyDocument'=>$this->propertyDocument->delete($request->getPropertyDocumentModel())
        ]]);
    }
    public function all(GetAllPropertyDocumentsRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyDocument'=>$this->propertyDocument->all()
        ]]);
    }


}
