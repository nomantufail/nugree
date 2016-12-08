<?php
namespace App\DB\Providers\SQL\Factories\Factories\Pages\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class PagesQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'pages';
    }

}