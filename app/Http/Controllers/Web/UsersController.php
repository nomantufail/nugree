<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\ForgetPasswordRequest;
use App\Http\Requests\Requests\User\GetAgentRequest;
use App\Http\Requests\Requests\User\GetAgentsRequest;
use App\Http\Requests\Requests\User\SearchUsersRequest;
use App\Http\Requests\Requests\User\TrustedAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\BannersRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\User\UsersFilesReleaser;
use App\Transformers\Response\UserTransformer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    use UsersFilesReleaser;
    public $userTransformer = null;
    public $usersJsonRepo = null;
    public $users = null;
    public $societies = null;
    public $rand= "";
    public $properties = "";
    public $banners ="";
    public $agencyRepo="";
    public $location ="";
    public function __construct(WebResponse $webResponse, UserTransformer $userTransformer)
    {
        $this->response = $webResponse;
        $this->users = (new UsersRepoProvider())->repo();
        $this->properties = (new PropertiesRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->userTransformer = $userTransformer;
        $this->usersJsonRepo = (new UsersJsonRepoProvider())->repo();
        $this->banners = (new BannersRepoProvider())->repo();
        $this->location = (new LocationsRepoProvider())->repo();
        $this->agencyRepo = (new AgenciesRepoProvider())->repo();
        $this->rand = new Helper();
    }

    public function store(AddUserRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->userTransformer->transform($request->all()));
    }
    public function forgetPassword()
    {
        return $this->response
            ->setView('auth.forget_password')->respond(['data' => []]);
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
    public function trustedAgents(GetAgentsRequest $request)
    {
        $searchedAgents = $this->usersJsonRepo->searchTrustedAgents($request->all());
        $totalAgentsFound = \Session::get('totalAgentsFound');
        return $this->response->setView('frontend.v1.agent_listing')->respond(['data' => [
            'agents' => $this->releaseUsersAgenciesLogo($searchedAgents),
            'allAgents' => $this->usersJsonRepo->getAllTrustedAgents(),
            'societies'=>$this->societies->all(),
            'locations'=>$this->location->all(),
            'params'=>$request->all(),
            'banners'=>$this->getAgentListingPageBanners(),
            'totalAgentsFound' => $totalAgentsFound[0]->count,
        ]]);
    }

    public function getTrustedAgent(GetAgentRequest $request)
    {
        $agency = $this->agencyRepo->getAgencyBySlug($request->get('agencySlug'));
        $userPropertiesState = $this->properties->userPropertiesState($agency[0]->user_id);
        return $this->response->setView('frontend.v1.agent-profile')->respond(['data' => [
            'agent' => $this->releaseAllUserFiles($this->usersJsonRepo->find($agency[0]->user_id)),
            'userPropertiesState' => $userPropertiesState,
            'banners'=>$this->getAgentDetailPageBanners()
        ]]);
    }
    public function makeTrustedAgent(TrustedAgentRequest $request)
    {
        $user = $request->getUserModel();
        return $this->response->setView('frontend.agent-profile')->respond(['data' => [
            'trustedAgent'=>$this->users->makeTrustedAgent($user)]]);
    }
    public function getAgentListingPageBanners()
    {
        $leftBanners = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'left',
            'page'=>'agent_listing'

        ]);

        $topBanners  = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'top',
            'page'=>'agent_listing'
        ]);
        $rightBanners  = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'right',
            'page'=>'agent_listing'
        ]);
        return $banners = [
            'leftBanners'=>$leftBanners,
            'topBanners'=>$topBanners,
            'rightBanners'=>$rightBanners
        ];
    }
    public function getAgentDetailPageBanners()
    {
        $leftBanners = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'left',
            'page'=>'agent-profile'
        ]);

        $topBanners  = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'top',
            'page'=>'agent-profile'
        ]);

        $rightBanners  = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'right',
            'page'=>'agent-profile'
        ]);
        return $banners = [
            'leftBanners'=>$leftBanners,
            'topBanners'=>$topBanners,
            'rightBanners'=>$rightBanners,
        ];
    }
}
