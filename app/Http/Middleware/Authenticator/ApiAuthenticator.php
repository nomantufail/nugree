<?php

namespace App\Http\Middleware\Authenticator;

use App\Http\Requests\Request;
use App\Http\Responses\Responses\ApiResponse;
use App\Libs\Auth\Api as Authenticator;
use Closure;

class ApiAuthenticator
{
    public $response;
    private $authenticator = null;
    public function __construct(ApiResponse $response, Authenticator $authenticator)
    {
        $this->response = $response;
        $this->authenticator = $authenticator;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param   $customRequest
     * @return mixed
     */
    public function handle($request, Closure $next, $customRequest)
    {
        /* @var $customRequest Request::class */
        $customRequest = ucfirst($customRequest);
        $customRequest = new $customRequest();
        if($customRequest->isNotAuthentic()){
            if(isset($_SESSION['authUser']))
                $this->authenticator->logout($_SESSION['authUser']);
            return $this->response->respondAuthenticationFailed();
        }

        return $next($request);
    }
}
