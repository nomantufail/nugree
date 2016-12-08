<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\UserRequirement\AddUserRequirementRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\UsersRequirementRepoProvider;
use App\Transformers\Response\UserTransformer;


class UserRequirementsController extends Controller
{
    public $userRequirement = "";
    public function __construct(WebResponse $webResponse, UserTransformer $userTransformer)
    {
        $this->response = $webResponse;
        $this->userRequirement = (new UsersRequirementRepoProvider())->repo();
    }

    public function store(AddUserRequirementRequest $request)
    {
        $this->userRequirement->store($request->getUserRequirementModel());
        return redirect('/');
    }
}
