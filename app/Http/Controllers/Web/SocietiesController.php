<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Society\DownloadSocietyFilesRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesForFilesRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesForMapsRequest;
use App\Http\Requests\Requests\Society\GetSocietyFilesRequest;
use App\Http\Requests\Requests\Society\GetSocietyMapsRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\SocietiesFilesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Repositories\Sql\SocietiesFilesRepository;
use App\Repositories\Repositories\Sql\SocietiesMapsRepository;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;
use App\Traits\Property\ShowAddPropertyFormHelper;
use App\Transformers\Response\PropertyTransformer;

class SocietiesController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper, ShowAddPropertyFormHelper;
    public $PropertyTransformer = null;
    public $societyMaps = "";
    public $societyFiles = "";
    public $societies = null;

    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->societyMaps = new SocietiesMapsRepository();
        $this->societyFiles = (new SocietiesFilesRepoProvider())->repo();
     }

    public function getAllSocietiesForMaps(GetAllSocietiesForMapsRequest $request)
    {
       return $this->response->setView('frontend.v2.societies')->respond(['data'=>[
           'societies'=>$this->societies->all()
       ]]);
    }
    public function getAllSocietiesForFiles(GetAllSocietiesForFilesRequest $request)
    {
        return $this->response->setView('frontend.v2.societies_for_files')->respond(['data'=>[
            'societiesForFiles'=>$this->societies->getSocietiesForFiles()
        ]]);
    }

    public function getSocietyMaps(GetSocietyMapsRequest $request)
    {
        return $this->response->setView('frontend.v2.maps')->respond(['data'=>[
            'societiesMaps'=>$this->societyMaps->getSocietyMaps($request->get('societyId'))
        ]]);
    }
    public function getSocietyFiles(GetSocietyFilesRequest $request)
    {
        return $this->response->setView('frontend.v2.files')->respond(['data'=>[
            'societyFiles'=>$this->societyFiles->getSocietyFiles($request->get('societyId')),
            'society'=>$this->societies->find($request->get('societyId'))
        ]]);
    }
    public function getSocietyImage(DownloadSocietyFilesRequest $request)
    {
        $societyFiles = $this->societyFiles->getSocietyFiles($request->get('societyId'));
        $pathToFile = public_path($societyFiles->image);
        return response()->download($pathToFile);
    }
    public function downloadSocietyPDF(DownloadSocietyFilesRequest $request)
    {
        $societyFiles = $this->societyFiles->getSocietyFiles($request->get('societyId'));
        $pathToFile = public_path($societyFiles->pdf);
        return response()->download($pathToFile);
    }
    public function getSocietyDoc(DownloadSocietyFilesRequest $request)
    {
        $societyFiles = $this->societyFiles->getSocietyFiles($request->get('societyId'));
        $pathToFile = public_path($societyFiles->doc);
        return response()->download($pathToFile);
    }
}
