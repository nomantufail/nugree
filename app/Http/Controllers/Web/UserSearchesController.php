<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\User\AddUserSearchesRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\CountriesRepoProvider;
use App\Repositories\Providers\Providers\UserSearchesRepoProvider;
use App\Transformers\Response\CityTransformer;

class UserSearchesController extends Controller
{
    public $response = null;
    public $userSearches = null;
    public function __construct(WebResponse $response,CityTransformer $countryTransformer)
    {
        $this->response = $response;
        $this->userSearches = (new UserSearchesRepoProvider())->repo();
    }
   public function store(AddUserSearchesRequest $request)
   {
       $this->userSearches->store($request->getUserSearchesModel());
       dd(header('Location: '.$request->get('searchedParams')));
   }

}
