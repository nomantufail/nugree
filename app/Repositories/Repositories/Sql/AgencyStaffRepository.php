<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Models\AgencyStaff;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;

class AgencyStaffRepository extends SqlRepository implements AgenciesRepoInterface
{
    private $factory = null;
    public function __construct(){
        $this->factory = new AgencyStaffFactory();
    }

   public function store(AgencyStaff $agencyStaff)
   {
        return $this->factory->store($agencyStaff);
   }
}
