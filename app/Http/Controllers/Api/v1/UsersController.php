<?php

namespace App\Http\Controllers\Api\V1;

use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\UserRole;
use App\Events\Events\User\UserUpdated;
use App\Http\Requests\Requests\Mail\MailFeedbackUsRequest;
use App\Http\Requests\Requests\User\ChangePasswordRequest;
use App\Http\Requests\Requests\User\ForgetPasswordRequest;
use App\Http\Requests\Requests\User\GetUserRequest;
use App\Http\Requests\Requests\User\UpdateUserRequest;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\AgencyLocationsRepoProvider;
use App\Repositories\Providers\Providers\AgencySocietiesRepoProvider;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\UserRolesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\AgencyLocationsRepository;
use App\Repositories\Repositories\Sql\UsersRepository;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Traits\User\UsersFilesReleaser;
use App\Transformers\Response\UserTransformer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UsersController extends ApiController
{
    use UsersFilesReleaser;

    private $userTransformer;
    /**
     * @var UsersRepository::class
     */
    private $users;
    private $usersJsonRepo;
    private $agencies;
    public $response;
    private $roles;
    private $userRoles;
    private $idForAgentBroker = 3;
    private $agencyStaff =null;
    private $agencySocieties = null;
    private $agencyLocations = null;
    public function __construct
    (
        ApiResponse $apiResponse, UserTransformer $userTransformer,
        UsersRepoProvider $usersRepository, AgenciesRepoProvider $agenciesRepoProvider,
        UsersJsonRepoProvider $usersJsonRepoProvider, RolesRepoProvider $rolesRepoProvider,
        UserRolesRepoProvider $userRolesRepoProvider, AgencySocietiesRepoProvider $agencySocietiesRepoProvider,
        AgencyLocationsRepoProvider $agencyLocationsRepoProvider
    )
    {
        $this->response = $apiResponse;
        $this->userTransformer = $userTransformer;
        $this->users = $usersRepository->repo();
        $this->agencies = $agenciesRepoProvider->repo();
        $this->usersJsonRepo = $usersJsonRepoProvider->repo();
        $this->roles = $rolesRepoProvider->repo();
        $this->userRoles = $userRolesRepoProvider->repo();
        $this->agencySocieties = $agencySocietiesRepoProvider->repo();
        $this->agencyLocations = $agencyLocationsRepoProvider->repo();
    }

    /**
     * @return \App\Http\Responses\Responses\json
     */
    public function index()
    {
        $users = $this->users->all();
        return $this->response->respond(['data'=>[
            'total' => $users->count(),
            'users'=>$users->all()
        ]]);
    }
    public function getNewPassword(ForgetPasswordRequest $request)
    {
        $user = $this->users->findByEmail($request->get('email'));
        $password  = $this->rand->rands();
        $user->password = bcrypt($password);
        $this->users->update($user);
        Mail::send('frontend.mail.forget_password',['user' => $user,'password'=>$password], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Nugree.com');
            $message->to($user->email)->subject('Nugree.com');
        });
        Session::flash('message', 'New password has been sent to your email address');
        return redirect()->back();
    }
    public function find(GetUserRequest $request)
    {
        return $this->response->respond(['data'=>[
            'user' => $this->releaseAllUserFiles($this->usersJsonRepo->find($request->get('userId')))
        ]]);
    }

    public function store(AddUserRequest $request)
    {

    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->getUserModel();
        $user->password = bcrypt($request->get('newPassword'));
        $this->users->update($user);
        return $this->response->respond(['data'=>[]]);
    }

    public function feedback(MailFeedbackUsRequest $request)
    {
        return $this->MailFeedbackUs($request);
    }

    /**
     * @param UpdateUserRequest $request
     * @return \App\Http\Responses\\json
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $user = $request->getUserModel();
        $this->users->update($user);

        if($this->userWasAgent($user->id))
        {
            $this->updateUserAgency($request, $user->id);

        }
        else if($request->userIsAgent())
        {
            $this->saveUserAgency($request, $user->id);

        }
        $this->updateUserRoles($request->getUserRoles(), $user->id);
        Event::fire(new UserUpdated($user));
        return $this->response->respond(['data'=>[
            'user'=>$this->releaseAllUserFiles($this->usersJsonRepo->find($user->id)),
            'agencyStaff'=>$this->usersJsonRepo->getStaffSiblings($user->id)
        ]]);
    }

    private function userWasAgent($userId)
    {
        $userRoles = $this->roles->getUserRoles($userId);
        $userRolesIds = Helper::propertyToArray($userRoles, 'id');
        return (in_array($this->idForAgentBroker, $userRolesIds))?true:false;
    }

    private function updateUserRoles($roles, $userId)
    {
        $userRoles = [];
        foreach($roles as $role)
        {
            $userRole = new UserRole();
            $userRole->roleId = $role;
            $userRole->userId = $userId;
            $userRoles[] = $userRole;
        }

        $this->userRoles->deleteByUserId($userId);
        $this->userRoles->storeMultiple($userRoles);
    }

    private function saveUser(UpdateUserRequest $request)
    {
        $userId = $this->users->store($request->getUserModel());
        $this->users->addRoles($userId, $request->getUserRoles());
        return $userId;
    }

    private function updateUserAgency(UpdateUserRequest $request, $userId)
    {
        $agency = $request->getAgencyModel();
        /* @var $existingAgency Agency*/
        $existingAgency = $this->agencies->getByUser($userId)[0];
        $existingAgency->name = $agency->name;
        $existingAgency->description = $agency->description;
        $existingAgency->phone = $agency->phone;
        $existingAgency->mobile = $agency->phone;
        $existingAgency->email = $agency->email;
        $existingAgency->address = $agency->address;

        $logoPath = $existingAgency->logo;
        if($request->hasCompanyLogo()){
            if($existingAgency->logo != null)
                File::delete(storage_path('app/'.$existingAgency->logo));
            $logoPath = $this->saveLogo($agency, $request->getCompanyLogo());
        }else if($request->get('companyLogoDeleted') == "true"){
            if($existingAgency->logo != null)
                File::delete(storage_path('app/'.$existingAgency->logo));
            $logoPath = null;
        }
        $existingAgency->logo = $logoPath;
        $this->agencies->updateAgency($existingAgency);


        $this->agencyLocations->update($existingAgency->id, $request->get('locations'));

    }
    private function saveUserAgency(UpdateUserRequest $request, $userId)
    {
        $agency = $request->getAgencyModel();
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
