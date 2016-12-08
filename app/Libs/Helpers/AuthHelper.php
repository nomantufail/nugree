<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 6/7/2016
 * Time: 8:32 AM
 */

namespace App\Libs\Helpers;

use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\RequestHelper;

class AuthHelper extends Helper
{
    use RequestHelper;

    private $users = null;
    public function __construct()
    {
        $this->users = (new UsersRepoProvider())->repo();
    }

    /**
     * @return \App\DB\Providers\SQL\Models\User|null
     */
    public function user()
    {
        if($this->isApi()){
            $accessToken = $this->getAccessToken();
            try{
                return $this->users->getByToken($accessToken);
            }catch (\Exception $e){
                return null;
            }
        }else{
            if(isset($_SESSION['authUser']) && $_SESSION['authUser'] != null)
                return $this->users->getById($_SESSION['authUser']->id);
            else
                return null;
        }
    }
}