<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Admin;

use App\DB\Providers\SQL\Factories\Factories\Admin\Gateways\AdminQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\Agency\Gateways\AgencyQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Admin;
use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\AgencySociety;

class AdminFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Admin();
        $this->tableGateway = new AdminQueryBuilder();
    }
    public function getStaffAgency($staffId)
    {
        $agency = $this->tableGateway->getStaffAgency($staffId);
        if($agency == null)
            throw new \Exception();

        return $this->map($agency);
    }
    public function findWhere(array $conditions)
    {
        return $this->map($this->tableGateway->first($conditions));
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function findBy($column, $value)
    {
        return $this->map($this->tableGateway->findBy($column, $value));
    }

    public function getByUser($userId)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['user_id' => $userId]));
    }

    /**
     * @param Agency $agency
     * @return bool
     **/
    public function update(Agency $agency)
    {
        $agency->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($agency->id, $this->mapAgencyOnTable($agency));
    }

    /**
     * @param array $where
     * @param array $data
     * @return bool
     **/
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }
    public function getUserAgency($userId)
    {
        return $this->mapCollection($this->tableGateway->getBy('user_id',$userId));
    }
    /**
     * @param Agency $agency
     * @return int
     **/
    public function store(Agency $agency)
    {
        $agency->createdAt = date('Y-m-d h:i:s');
        $agency->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapAgencyOnTable($agency));
    }

    /**
     * @param int $agencyId
     * @param int $cityIds
     * @return int
     **/
    public function addCities($agencyId, $cityIds)
    {
        return $this->tableGateway->addCities($agencyId, $cityIds);
    }

    /**
     * @param Agency $agency
     * @return bool
     */
    public function delete(Agency $agency)
    {
        return $this->tableGateway->delete($agency->id);
    }

    /**
     * @param $result
     * @return Agency::class
     **/
    public function map($result)
    {
        $admin = clone($this->model);
        $admin->name = $result->name;
        $admin->email = $result->email;
        $admin->createdAt = $result->created_at;
        $admin->updatedAt = $result->updated_at;
        return $admin;
    }

    /**
     * @param Agency $agency
     * @return array
     **/

}
