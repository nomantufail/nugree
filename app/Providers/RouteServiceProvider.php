<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */

    protected $webNamespace = 'App\Http\Controllers\Web';
    protected $v1ApiNamespace = 'App\Http\Controllers\Api\v1';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        //web routes
        $router->group(['middleware'=>['web'], 'namespace' => $this->webNamespace], function ($router) {
            require app_path('Http/Routes/Web/routes.php');
            require app_path('Http/Routes/Web/apps.php');
        });

        //api routes
        include_once(app_path('Http/Controllers/Api/v1/ApiController.php'));
        $router->group(['middleware'=>['api'], 'prefix' => 'api/v1', 'namespace' => $this->v1ApiNamespace], function ($router) {
            require app_path('Http/Routes/Api/routes.php');
        });
    }
}
