<?php
namespace App\DB\Providers\SQL\Factories\Factories\NewsImages\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\BannersPages\BannersPagesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\DB\Providers\SQL\Factories\Factories\BannersSocieties\BannersSocietiesFactory;
use App\DB\Providers\SQL\Factories\Factories\Pages\PagesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use App\Libs\Helpers\LandArea;
use Illuminate\Support\Facades\DB;
class NewsImagesQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'news_images';
    }

}