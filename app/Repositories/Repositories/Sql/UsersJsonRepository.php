<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\UserJson\UserJsonFactory;
use App\Events\Events\User\UserCreated;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\Models\Sql\UserDocument;
use App\Models\Sql\UserJson;
use App\Repositories\Interfaces\Repositories\UsersJsonRepoInterface;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Models\Sql\User;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Transformers\Sql\UserJsonTransformer;
use Illuminate\Support\Facades\Event;

class UsersJsonRepository extends SqlRepository implements UsersJsonRepoInterface
{
    private $userJsonTransformer;
    private $factory = null;
    private $agencies = null;
    public function __construct(){
        $this->userJsonTransformer = new UserJsonTransformer();
        $this->factory = new UserJsonFactory();

        $this->agencies = (new AgenciesRepoProvider())->repo();
    }

    public function all()
    {
        return $this->factory->all();
    }
    public function getAgencyStaff($agencyId)
    {
        return $this->factory->getAgencyStaff($agencyId);
    }
    public function getStaffByOwner($userId)
    {
        return $this->factory->getStaffByOwner($userId);
    }
    public function getTrustedAgentsWithPriority(array $params)
    {
        return $this->factory->getTrustedAgentsWithPriority($params);
    }
    public function getAllTrustedAgents()
    {
        return $this->factory->getAllTrustedAgents();
    }
    public function searchTrustedAgents($params)
    {
        return $this->factory->searchTrustedAgents($params);
    }
    public function search(array $params)
    {

    }
    public function find($id)
    {
        return $this->factory->find($id);
    }

    public function getStaffSiblings($staffId)
    {
        try{
            $agency = $this->agencies->getStaffAgency($staffId);
            return $this->getAgencyStaff($agency->id);
        }catch (\Exception $e){
            return [$this->find($staffId)];
        }
    }

    public function store(UserJsonPrototype $user)
    {
        return $this->factory->store($user);
    }

    public function update($user)
    {
        return $this->factory->update($user);
    }

    public function delete($id)
    {

    }

    public function updateWhere(array $condition ,array $data)
    {
        return $this->factory->updateWhere($condition ,$data);
    }
    public function getPendingAgents()
    {
        return $this->factory->getPendingAgents();
    }
}
