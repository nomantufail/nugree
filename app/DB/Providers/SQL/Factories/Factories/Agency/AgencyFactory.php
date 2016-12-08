<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Agency;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\Agency\Gateways\AgencyQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\AgencySociety;

class AgencyFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Agency();
        $this->tableGateway = new AgencyQueryBuilder();
    }
    public function getStaffAgency($staffId)
    {
        $agency = $this->tableGateway->getStaffAgency($staffId);
        if($agency == null)
            throw new \Exception();

        return $this->map($agency);
    }
    public function getAgencyBySlug($agencySlug)
    {
        return $this->tableGateway->getWhere(['slug'=>$agencySlug]);
    }
    public function findWhere(array $conditions)
    {
        return $this->map($this->tableGateway->getWhere($conditions)->first());
    }

    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    /**
     * @return array Agency::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    /**
     * @param int $id
     * @return Agency::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    /**
     * @param string $column
     * @param string $value
     * @return Agency::class
     **/
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
        $agency = clone($this->model);
        $agency->id = $result->id;
        $agency->name = $result->agency;
        $agency->description = $result->description;
        $agency->mobile = $result->mobile;
        $agency->phone = $result->phone;
        $agency->address = $result->address;
        $agency->email = $result->email;
        $agency->userId = $result->user_id;
        $agency->logo = ($result->logo == null)?'':$result->logo;
        $agency->slug = $result->slug;
        $agency->createdAt = $result->created_at;
        $agency->updatedAt = $result->updated_at;
        return $agency;
    }

    /**
     * @param Agency $agency
     * @return array
     **/
    private function mapAgencyOnTable(Agency $agency)
    {
        return [
            'agency' => $agency->name,
            'description' => $agency->description,
            'mobile' => $agency->mobile,
            'phone' => $agency->phone,
            'address' => $agency->address,
            'email' => $agency->email,
            'user_id' => $agency->userId,
            'logo' => $agency->logo,
            'slug'=>$agency->slug,
            'updated_at' => $agency->updatedAt,
            'created_at' => $agency->createdAt,
        ];
    }
}
