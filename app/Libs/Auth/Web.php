<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:55 AM
 */

namespace App\Libs\Auth;


use App\DB\Providers\SQL\Models\User;
use App\Events\Events\User\UserBasicInfoUpdated;
use Illuminate\Support\Facades\Session;

class Web extends Authenticate implements AuthInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param User $authenticatedUser
     * @return User
     */
    public function login(User $authenticatedUser){
        return parent::login($authenticatedUser);
    }

    public function authenticate()
    {
        return ($this->user() == null)?false: true;
    }

    public function user()
    {
        if(isset($_SESSION['authUser']) && $_SESSION['authUser'] == null){
            return null;
        }else{
            try{
                return $this->users->getById($_SESSION['authUser']->id);
            }catch (\Exception $e){
                return null;
            }
        }
    }


}