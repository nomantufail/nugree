<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\PropertyLike\AddPropertyLikeRequest;
use App\Http\Requests\Requests\PropertyLike\DeletePropertyLikeRequest;
use App\Http\Requests\Requests\PropertyLike\GetAllPropertyLikeRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\PropertyLikesRepoProvider;
use App\Transformers\Response\CityTransformer;

class PropertyLikeController extends ApiController
{
    private $propertyLike = null;
    public $response = null;
    public function __construct
    (
        ApiResponse $response,CityTransformer $countryTransformer,
        PropertyLikesRepoProvider $PropertyLikeRepository
    )
    {
        $this->propertyLike =  $PropertyLikeRepository->repo();
        $this->response = $response;
    }
    public function store(AddPropertyLikeRequest $request)
    {
        $propertyLike = $request->getPropertyLikeModel();
        $propertyLike->id = $this->propertyLike->store($propertyLike);
        $totalLikes = $this->propertyLike->getTotalLikes($propertyLike);
        return $this->response->respond(['data' => [
          'totalLikes'=>$totalLikes
        ]]);
    }

    public function delete(DeletePropertyLikeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyLike'=>$this->propertyLike->delete($request->getPropertyLikeModel())
        ]]);
    }
    public function all(GetAllPropertyLikeRequest $request)
    {
        return $this->response->respond(['data'=>[
            'propertyLike'=>$this->propertyLike->all()
        ]]);
    }
}
