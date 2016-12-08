<?php

namespace App\Providers;

use App\DB\Providers\SQL\Models\Meta;
use App\Libs\Auth\Web;
use App\Repositories\Providers\Providers\MetaRepoProvider;
use App\Repositories\Repositories\Sql\PropertyTypeRepository;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $propertyTypes;
    public $page;
    public $metaRepo;
    public $meta;
    public function __construct()
    {
        $this->propertyTypes = new PropertyTypeRepository();
        $this->metaRepo = (new MetaRepoProvider())->repo();
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        @session_start();
//        $data = [
//            'propertyTypes' =>$this->propertyTypes->all(),
//            'authUser' => (new Web())->user(),
//        ];
//        view()->share('globals', $data);
    }


    public function getMeta($pageName)
    {
        return $this->metaRepo->getPageMeta($pageName);
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
