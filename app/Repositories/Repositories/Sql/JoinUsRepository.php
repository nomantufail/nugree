<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\JoinUs\JoinUsFactory;
use App\DB\Providers\SQL\Models\JoinUs;
use App\Events\Events\JoinUs\JoinUsMail;
use App\Repositories\Interfaces\Repositories\UserRoleRepoInterface;
use Illuminate\Support\Facades\Event;

class JoinUsRepository extends SqlRepository implements UserRoleRepoInterface
{
    private $factory = null;
    public function __construct()
    {
        $this->factory = new JoinUsFactory();
    }
    public function store(JoinUs $joinUs)
    {
        $this->factory->store($joinUs);
        return Event::fire(new JoinUsMail($joinUs));
    }
}
