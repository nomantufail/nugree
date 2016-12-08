<?php

namespace App\Http\Middleware\Validator;

use App\Http\Responses\Responses\ApiResponse;
use Closure;

class ApiValidator
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
     * @param  $customRequest
     * @return mixed
     */
    public function handle($request, Closure $next, $customRequest)
    {
        $customRequest = ucfirst($customRequest);
        $customRequest = new $customRequest();
        if(!$customRequest->validate())
        {
            return $this->response->respondValidationFails($customRequest->validator->getValidationMessages());
        }

        return $next($request);
    }
}
