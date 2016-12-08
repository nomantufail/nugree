<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\UserRequirement\UserRequirementFactory;
use App\DB\Providers\SQL\Models\UserRequirement;
use App\Events\Events\UserRequirement\UserRequirements;
use App\Repositories\Interfaces\Repositories\UserRoleRepoInterface;
use Illuminate\Support\Facades\Event;

class UserRequirementsRepository extends SqlRepository implements UserRoleRepoInterface
{
    private $factory = null;
    public function __construct()
    {
        $this->factory = new UserRequirementFactory();
    }
    public function store(UserRequirement $userRequirement)
    {
        $this->factory->store($userRequirement);
        return Event::fire(new UserRequirements($userRequirement));
    }
}
