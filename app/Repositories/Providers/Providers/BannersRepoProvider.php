<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/28/2016
 * Time: 11:30 AM
 */

namespace App\Repositories\Providers\Providers;




use App\Repositories\Providers\RepositoryProvider;
use App\Repositories\Providers\RepositoryProviderInterface;
use App\Repositories\Repositories\Sql\BannerPagesRepository;
use App\Repositories\Repositories\Sql\BannerSocietiesRepository;
use App\Repositories\Repositories\Sql\BannersRepository;
use App\Repositories\Repositories\Sql\BannersSizesRepository;

class BannersRepoProvider extends RepositoryProvider implements RepositoryProviderInterface
{

    public function repo()
    {
        return new BannersRepository();
    }
    public function bannerSocieties()
    {
        return new BannerSocietiesRepository();
    }
    public function bannerSizes()
    {
        return new BannersSizesRepository();
    }
    public function bannerPages()
    {
        return new BannerPagesRepository();
    }
}