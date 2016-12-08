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
use App\Repositories\Repositories\Sql\MetaRepository;

class MetaRepoProvider extends RepositoryProvider implements RepositoryProviderInterface
{

    public function repo()
    {
        return new MetaRepository();
    }
}