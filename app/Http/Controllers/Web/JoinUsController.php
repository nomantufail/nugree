<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\JoinUs\AddJoinUsRequest;
use App\Http\Requests\Requests\Society\DownloadSocietyFilesRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesForFilesRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesForMapsRequest;
use App\Http\Requests\Requests\Society\GetSocietyFilesRequest;
use App\Http\Requests\Requests\Society\GetSocietyMapsRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\JoinUsRepoProvider;
use App\Repositories\Providers\Providers\SocietiesFilesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Repositories\Sql\JoinUsRepository;
use App\Repositories\Repositories\Sql\SocietiesFilesRepository;
use App\Repositories\Repositories\Sql\SocietiesMapsRepository;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;
use App\Traits\Property\ShowAddPropertyFormHelper;
use App\Transformers\Response\PropertyTransformer;

class JoinUsController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper, ShowAddPropertyFormHelper;
    public $PropertyTransformer = null;
    public $joinUs = null;

    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
        $this->joinUs = (new JoinUsRepoProvider())->repo();

    }
    public function store(AddJoinUsRequest $request)
    {
        $this->joinUs->store($request->getUserJoinUsRequirementModel());
        return redirect('/');
    }


}
