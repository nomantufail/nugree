<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/17/2016
 * Time: 12:08 PM
 */

namespace App\Libs\Auth;


use App\DB\Providers\SQL\Models\User;
use App\Events\Events\User\UserBasicInfoUpdated;
use App\Libs\Auth\Traits\TokenGenerator;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
abstract class Authenticate
{
    use TokenGenerator;

    public $users = null;
    public function __construct()
    {
        $this->users = (new UsersRepoProvider())->repo();
    }

    /**
     * @param array $credentials
     * @return bool
     */
    public function attempt(array $credentials)
    {
        try{
            $user = $this->users->findByEmail($credentials['email']);
        }
        catch (\Exception $e){
            return false;
        }

        if(!Hash::check($credentials['password'], $user->password))
            return false;

        return true;
    }

    /**
     * @param User $authenticatedUser
     * @return User
     */
    public function login(User $authenticatedUser){
        $authenticatedUser->access_token = $this->generateToken($authenticatedUser->id);
        $this->users->update($authenticatedUser);
        Event::fire(new UserBasicInfoUpdated($authenticatedUser));
        $_SESSION['authUser'] =  $authenticatedUser;
        return $authenticatedUser;
    }

    public function logout(User $authenticatedUser)
    {
        $authenticatedUser->access_token = null;
        $this->users->update($authenticatedUser);
        if($_SESSION['authUser']){
            unset($_SESSION['authUser']);
            session()->pull('authUser');
            session()->flush();
            session()->save();
        }
        return true;
    }

}