<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

/**
 * --------------------------
 * Below trait must be used
 * with a migration class.
 * -------------------------
 **/
namespace App\Traits;
use App\Libs\Auth\Api as ApiAuthenticator;
use App\Libs\Auth\Web as WebAuthenticator;

trait RequestHelper
{
    use AppTrait;

    public function requestType()
    {
        $routeParts = explode('/', request()->route()->getPrefix());
        if(isset($routeParts[0]) && $routeParts[0] == 'api')
            return 'api';

        return 'web';
    }

    /*
     * incoming request is an api request or not?
     */
    public function isApi()
    {
        return ($this->requestType() == 'api')?true:false;
    }

    /*
     * incoming request is a web request or not?
     */
    public function isWeb()
    {
        return (!$this->isApi())?true: false;
    }

    /*
     * returns web/api Authenticator for the request.
     */
    public function getRequestAuthenticator()
    {
        return ($this->isApi())?$this->apiAuthenticatorWithToken(): new WebAuthenticator();
    }

    /*
     * returns apiAuthenticator with Authorization
     * key...
     */
    public function apiAuthenticatorWithToken()
    {
        $authenticator = new ApiAuthenticator();
        $authenticator->setAccessToken($this->getAccessToken());
        return $authenticator;
    }
     /*
     * return Authorization token within the
     * incoming request.
     */
    public function getAccessToken()
    {
        // before running unit tests...
        //$headers['Authorization'] = '$2y$10$tSM.PiN9BnMfyonqjHlwTONa1DPHbyQSAMOtmt4chJYXenGeYySHC';
        $headers = apache_request_headers();
        return (isset($headers['Authorization']))?$headers['Authorization']:null;
    }
}