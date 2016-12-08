<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Feature\AddFeatureRequest;
use App\Http\Requests\Requests\Feature\DeleteFeatureRequest;
use App\Http\Requests\Requests\Feature\GetPropertySubTypeAssignedFeatures;
use App\Http\Requests\Requests\Feature\UpdateFeatureRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;

class FeaturesController extends ApiController
{
    private $features = null;
    public $response = null;
    public function __construct
    (
        FeaturesRepoProvider $FeatureSection,
        ApiResponse $response
    )
    {
        $this->features  = $FeatureSection->repo();
        $this->response = $response;
    }

    public function allAssigned(GetPropertySubTypeAssignedFeatures $request)
    {
        return $this->response->respond(['data'=>[
            'features'=>$this->features->allAssigned()
        ]]);
    }
    public function store(AddFeatureRequest $request)
    {
        $feature = $request->GetFeatureModel();
        $feature->id = $this->features->store($feature);
        return $this->response->respond(['data' => [
            'feature' =>$feature
        ]]);
    }
    public function update(UpdateFeatureRequest $request)
    {
        $feature = $request->GetFeatureModel();
        $this->features->update($feature);
        return $this->response->respond(['data' => [
            'feature' =>$feature
        ]]);
    }
    public function delete(DeleteFeatureRequest $request)
    {
        return $this->response->respond(['data'=>[
            'feature'=>$this->features->delete($request->GetFeatureModel())
        ]]);
    }

}