<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Events\Events\Section\SectionUpdated;
use App\Http\Requests\Requests\FeatureSection\AddFeatureSectionRequest;
use App\Http\Requests\Requests\FeatureSection\DeleteFeatureSectionRequest;
use App\Http\Requests\Requests\FeatureSection\GetAllFeatureSectionRequest;
use App\Http\Requests\Requests\FeatureSection\UpdateFeatureSectionRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\FeatureSectionsRepoProvider;
use Illuminate\Support\Facades\Event;

class FeatureSectionsController extends ApiController
{
    private $FeatureSection = null;
    public $response = null;
    public function __construct
    (
        FeatureSectionsRepoProvider $FeatureSection,
        ApiResponse $response
    )
    {
        $this->FeatureSection  = $FeatureSection->repo();
        $this->response = $response;
    }
    public function store(AddFeatureSectionRequest $request)
    {
        $FeatureSection =$request->getFeatureSectionModel();
        $FeatureSection->id = $this->FeatureSection->store($FeatureSection);
        return $this->response->respond(['data' => [
            'featureSection' => $FeatureSection
        ]]);
    }
    public function all(GetAllFeatureSectionRequest $request)
    {
        return $this->response->respond(['data'=>[
            'featureSections'=>$this->FeatureSection->all()
        ]]);
    }
    public function delete(DeleteFeatureSectionRequest $request)
    {
        return $this->response->respond(['data'=>[
            'featureSection'=>$this->FeatureSection->delete($request->getFeatureSectionModel())
        ]]);
    }
    public function update(UpdateFeatureSectionRequest $request)
    {
        $FeatureSection =$request->getFeatureSectionModel();
        $this->FeatureSection->update($FeatureSection);
        Event::fire(new SectionUpdated($FeatureSection));
        return $this->response->respond(['data' => [
            'featureSection' => $FeatureSection
        ]]);
    }
    public function getPropertyFeatures()
    {
        return $this->response->respond([
            'data'=>[
                'featureSection'=>$this->FeatureSection->all()
            ]
        ]);
    }


}