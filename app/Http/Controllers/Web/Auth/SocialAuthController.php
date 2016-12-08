<?php
namespace App\Http\Controllers\Web\Auth;

use App\DB\Providers\SQL\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Auth\Web as Authenticator;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Socialite;

class SocialAuthController extends Controller
{
    private $users = null;
    private $auth = null;
    public $response = null;

    public function __construct()
    {
        $this->users = (new UsersRepoProvider())->repo();
        $this->response = new WebResponse();
        $this->auth = new Authenticator();
    }

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try{
            $providerUser = \Socialite::driver('facebook')->user();
            try{
                $existingUser = $this->users->findByEmail($providerUser->email);
                return $this->login($existingUser);
            }catch (\Exception $e){
                return $this->register($providerUser);
            }
        }catch (\Exception $e){
            return redirect()->route('loginPage');
        }
    }

    public function login($existingUser)
    {
        $authenticatedUser = $this->auth->login($existingUser);

        if($authenticatedUser == null)
            $this->response->respondInternalServerError();

        return redirect()->route('dashboard');
    }

    public function register($fbUser)
    {
        $user = new User();
        $user->fName = explode(' ',$fbUser->name)[0];
        $user->lName = isset(explode(' ',$fbUser->name)[1])?explode(' ',$fbUser->name)[1]:'';
        $user->email = $fbUser->email;
        $user->password = bcrypt($fbUser->id);
        $user->countryId = 1;
        $user->membershipPlanId = 1;
        $user->trustedAgent = 0;

        $user = $this->users->store($user);
        $this->users->addRoles($user->id, [1]);

        return $this->login($user);
    }
}

