<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory;
use App\DB\Providers\SQL\Factories\Factories\Mail\MailFactory;
use App\DB\Providers\SQL\Models\Location;
use App\Repositories\Interfaces\Repositories\SocietiesRepoInterface;

class MailRepository extends SqlRepository implements SocietiesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new MailFactory();
    }
    public function storeContactUsMail($record)
    {
        return $this->factory->storeContactUsMail($record);
    }

}