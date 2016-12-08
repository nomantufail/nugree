<?php

namespace App\Http\Controllers\Web\Auth;

use App\DB\Providers\SQL\Models\Agency;
use App\Http\Controllers\Web\WebController;
use App\Http\Requests\Requests\Auth\LoginRequest;
use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Auth\Web as Authenticator;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Transformers\Sql\UserTransformer;
use App\User;
use Validator;


class AuthController extends WebController
{
    private $auth;
    private $users;
    private $userTransformer;
    public $response;
    private $agencies;
    private $roles;
    private $location="";
    public $propertyTypes;
    public $propertySubtypes;
    public $cities = null;
    public function __construct
    (
        WebResponse $response, Authenticator $authenticator,
        UsersRepoProvider $usersRepoProvider, UserTransformer $userTransformer
    )
    {
        $this->roles = (new RolesRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->auth = $authenticator;
        $this->users = $usersRepoProvider->repo();
        $this->response = $response;
        $this->userTransformer = $userTransformer;
        $this->location = (new LocationsRepoProvider())->repo();
        $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
        $this->propertySubtypes = (new PropertySubTypesRepoProvider())->repo();
        $this->agencies = (new AgenciesRepoProvider())->repo();
        $this->cities = (new CitiesRepoProvider())->repo();
    }
    public function showLoginPage()
    {
        if(isset($_SESSION['authUser']))
            return redirect()->route('dashboard');
        return $this->response->setView('frontend.v1.auth.login')->respond(['data'=>[
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes->all()
        ]]);
    }

    public function login(LoginRequest $request)
    {
        if(!$this->auth->attempt($request->getCredentials())){
            return $this->response->respondInvalidCredentials();
        }

        $authenticatedUser = $this->auth->login($this->users->findByEmail($request->get('email')));

        if($authenticatedUser == null)
            $this->response->respondInternalServerError();

        return redirect()->route('dashboard');
    }

    public function showRegisterPage()
    {
        return $this->response->setView('frontend.v1.auth.register')->respond([
            'roles' => $this->roles->all(),
            'locations' => $this->location->all(),
            'cities'=>$this->cities->all()
        ]);
    }

    public function register(RegistrationRequest $request)
    {
        $user = $this->saveUser($request);
        if($request->userIsAgent())
        {
            $this->saveUserAgency($request, $user->id);
        }
        \Session::flash('success', ''.$user->fName.' '.$user->lName.' you are register Successfully');
        return redirect()->route('loginPage');
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
        $agency->slug = $agency->slug.$userId;
        $agency->userId = $userId;
        $logoPath = null;
        if($request->hasCompanyLogo()){
            $logoPath = $this->saveLogo($agency, $request->getCompanyLogo());
        }
        $agency->logo = $logoPath;
        $agencyId = $this->agencies->storeAgency($agency);
        $this->agencies->addLocations($request->getAgencyLocations($agencyId));
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
