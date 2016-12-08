<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;



use App\DB\Providers\SQL\Factories\Factories\Admin\AdminFactory;
use App\Repositories\Interfaces\Repositories\AdminsRepoInterface;

class AdminsRepository extends SqlRepository implements AdminsRepoInterface
{
    public $factory = "";
    public function __construct()
    {
      $this->factory = new AdminFactory();
    }
    public function getAdmin(array $params)
    {
        return $this->factory->findWhere(['email'=>$params['email']]);
    }
}
