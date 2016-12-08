<?php

namespace App\Http\Middleware\Validator;

use App\Http\Responses\Responses\WebResponse;
use Closure;

class WebValidator
{
    public $response;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
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
