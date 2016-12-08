<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\AgencyStaff;

use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\Gateways\AgencyStaffQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\AgencyStaff;
use App\DB\Providers\SQL\Models\Block;


class AgencyStaffFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->tableGateway = new AgencyStaffQueryBuilder();
    }
    public function store(AgencyStaff $agencyStaff)
    {
        return $this->tableGateway->insert($this->mapOnTable($agencyStaff));
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
         $this->tableGateway->setTable($table);
    }
    public function mapOnTable(AgencyStaff $agencyStaff)
    {
        return [
            'agency_id'=>$agencyStaff->agencyId,
            'user_id'=>$agencyStaff->userId,
        ];
    }
    public function map($result){}
    public function find($id){}
    public function all(){}
}