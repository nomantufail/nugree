<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\User;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\User\Gateways\UserQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\User as UserModel;
use App\DB\Providers\SQL\Models\User;
use Mockery\CountValidator\Exception;

class UserFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->tableGateway = new UserQueryBuilder();
    }

    /**
     * @param string $token
     * @return UserModel::class
     * @throws \Exception
     **/
    public function findByToken($token)
    {
        $user = $this->tableGateway->findBy('access_token', $token);
        if($user == null)
            throw new \Exception();
        return $this->map($user);
    }

    public function findWhere(array $conditions)
    {
        return $this->map($this->tableGateway->first($conditions));
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    public function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    /**
     * @return array UserModel::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function makeTrustedAgent(User $user)
    {
        $user->trustedAgent = 1;
        return $this->tableGateway->updateWhere(['id'=>$user->id],$this->mapUserOnTable($user));
    }
    public function approveAgent(User $user)
    {
        return $this->tableGateway->updateWhere(['id'=>$user->id],$this->mapUserOnTable($user));
    }
    /**
     * @param $id
     * @return UserModel
     * @throws \Exception
     */
    public function find($id)
    {
        $user = $this->tableGateway->find($id);
        if($user == null)
            throw new \Exception();
        return $this->map($user);
    }

    /**
     * @param $column
     * @param $value
     * @return UserModel
     * @throws \Exception
     */
    public function findBy($column, $value)
    {
        $user = $this->tableGateway->findBy($column, $value);
        if($user == null)
            throw new \Exception();

        return $this->map($user);
    }

    /**
     * @param string $email
     * @return UserModel::class
     **/
    public function findByEmail($email)
    {
        return $this->findBy('email', $email);
    }

    /**
     * @param UserModel $user
     * @return bool
     **/
    public function update(UserModel $user)
    {
        $user->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($user->id, $this->mapUserOnTable($user));
    }
    public function delete(UserModel $user)
    {
        return $this->tableGateway->delete($user->id);
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

    /**
     * @param UserModel $user
     * @return int
     **/
    public function store(UserModel $user)
    {
        $user->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapUserOnTable($user));
    }

    /**
     * @param int $userId
     * @param array $roleIds
     * @return int
     **/
    public function addRoles($userId, $roleIds)
    {
        return $this->tableGateway->addRoles($userId, $roleIds);
    }

    /**
     * @param $result
     * @return UserModel::class
     **/
    public function map($result)
    {
        $user = clone($this->model);
        $user->id = $result->id;
        $user->fName = $result->f_name;
        $user->lName = $result->l_name;
        $user->email = $result->email;
        $user->password = $result->password;
        $user->access_token = $result->access_token;
        $user->phone = $result->phone;
        $user->mobile = $result->mobile;
        $user->address = $result->address;
        $user->zipCode = $result->zipcode;
        $user->trustedAgent = $result->trusted_agent;
        $user->fax = $result->fax;
        $user->loginCount = $result->login_count;
        $user->countryId = $result->country_id;
        $user->membershipPlanId = $result->membership_plan_id;
        $user->membershipStatus = $result->membership_status;
        $user->notificationSettings = $result->notification_settings;
        return $user;
    }

    /**
     * @param UserModel $user
     * @return array
     **/
    private function mapUserOnTable(UserModel $user)
    {
        return [
            'f_name' => $user->fName,
            'l_name' => $user->lName,
            'email' => $user->email,
            'password' => $user->password,
            'phone' => $user->phone,
            'address' => $user->address,
            'zipcode' => $user->zipCode,
            'trusted_agent'=>$user->trustedAgent,
            'mobile' => $user->mobile,
            'fax' => $user->fax,
            'access_token' => $user->access_token,
            'notification_settings' => $user->notificationSettings,
            'membership_status' => $user->membershipStatus,
            'country_id' => $user->countryId,
            'login_count'=>$user->loginCount,
            'membership_plan_id' => $user->membershipPlanId,
            'created_at' => $user->createdAt,
            'updated_at' => $user->updatedAt,
        ];
    }
}
