<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DB\Providers\SQL\Models\Agency;
use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Requests\Requests\Auth\LoginRequest;
use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Libs\Auth\Api as Authenticator;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use App\Repositories\Repositories\Sql\UsersRepository;
use App\Transformers\Response\UserTransformer;

class AuthController extends ApiController
{
    private $auth = null;
    private $users = null;
    private $agencies = null;
    private $userTransformer;
    public $response;
    public function __construct
    (
        ApiResponse $response, Authenticator $authenticator,
        UsersRepository $usersRepository, AgenciesRepository $agenciesRepository,
        UserTransformer $userTransformer
    )
    {
        $this->auth = $authenticator;
        $this->users = $usersRepository;
        $this->agencies = $agenciesRepository;
        $this->response = $response;
        $this->userTransformer = $userTransformer;
    }
    public function login(LoginRequest $request)
    {
        if(!$this->auth->attempt($request->getCredentials()))
            return $this->response->respondInvalidCredentials();
        $authenticatedUser = $this->auth->login($this->users->findByEmail($request->get('email')));
        return $this->response->respond(['data'=>[
            'authUser' => $authenticatedUser
        ]]);
    }

    public function register(RegistrationRequest $request)
    {
        $user = $this->saveUser($request);
        if($request->userIsAgent())
        {
            $this->saveUserAgency($request, $user->id);
        }
        return $this->response->respond(['data'=>[
            'user'=>$user
        ]]);
    }

    private function saveUser(RegistrationRequest $request)
    {
        $user = $this->users->store($request->getUserModel());
        $this->users->addRoles($user->id, $request->getUserRoles());
        return $user;
    }

    private function saveUserAgency(RegistrationRequest $request, $userId)
    {
        $agency = $request->getAgencyModel();
        $agency->userId = $userId;
        $logoPath = null;
        if($request->hasCompanyLogo())
        {
            $logoPath = $this->saveLogo($agency, $request->getCompanyLogo());
        }
        $agency->logo = $logoPath;
        $agencyId = $this->agencies->storeAgency($agency);
        $this->agencies->addSocieties($request->getAgencySocieties($agencyId));
        return $agencyId;
    }

    private function saveLogo(Agency $agency, $logo)
    {
        $newName = $this->getCompanyLogoName($agency, $logo);
        $logo->move($this->getCompanyLogoStoragePath($agency), $newName);
        return $this->inStorageLogoPath($agency).'/'.$newName;
    }

    private function getCompanyLogoName(Agency $agency, $logo)
    {
        return md5($agency->name).'.'.$logo->getClientOriginalExtension();
    }

    private function getCompanyLogoStoragePath(Agency $agency)
    {
        return storage_path('app/'.$this->inStorageLogoPath($agency).'/');
    }

    private function inStorageLogoPath(Agency $agency)
    {
        return 'users/'.md5($agency->userId).'/agencies/'.md5($agency->name);
    }
}
