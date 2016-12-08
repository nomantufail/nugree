<?php

namespace App\Http\Middleware\Authorizer;

use App\Http\Responses\Responses\ApiResponse;
use Closure;

class ApiAuthorizer
{
    public $response;
    public function __construct(ApiResponse $apiResponse)
    {
        $this->response = $apiResponse;
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
        $customRequest = ucfirst($customRequest);
        $customRequest = new $customRequest();
        if(!$customRequest->authorize())
        {
            return $this->response->respondOwnershipConstraintViolation($customRequest->validator->getValidationMessages());
        }

        return $next($request);
    }
}
