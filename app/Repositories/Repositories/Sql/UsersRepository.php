<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\Collections\Collections\UserCollection;
use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\DB\Providers\SQL\SQLFactoryProvider;
use App\Events\Events\User\UpdateAgentStatus;
use App\Events\Events\User\UserCreated;
use App\Events\Events\User\UserRolesChanged;
use App\Events\Events\User\UserUpdated;
use App\Libs\Helpers\Helper;
use App\Libs\Json\Creators\Creators\UserJsonCreator;
use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\DB\Providers\SQL\Models\User;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Transformers\Sql\UserTransformer;
use Illuminate\Support\Facades\Event;

class UsersRepository extends SqlRepository implements UsersRepoInterface
{
    private $userTransformer;
    private $factory = null;
    private $idForAgentBroker = 3;
    public function __construct(){
        $this->userTransformer = new UserTransformer();
        $this->factory = SQLFactoryProvider::user();
    }

    public function getWithRelations(array $where = [])
    {
        return  $this->users->where($where)
                ->with('country')
                ->with('membershipPlan')
                ->with('agencies')
                ->get();
    }

    public function getFirstWithRelations(array $where = [])
    {
        $user = $this->getWithRelations($where)->first();
        return $this->userTransformer->transform($user);
    }

    /**
     * @param string $column
     * @param string $value
     * @return User
     */
    public function findBy($column, $value)
    {
        return $this->factory->findBy($column, $value);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail($email = "")
    {
        return $this->factory->findByEmail($email);
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }
    public function makeTrustedAgent(User $user)
    {
        $this->factory->makeTrustedAgent($user);
        return Event::fire(new UserUpdated($user));
    }
    public function getByToken($token)
    {
        return $this->factory->findByToken($token);
    }

    public function getByCredentials(array $credentials)
    {
        return $this->factory->findWhere($credentials);
    }

    public function all()
    {
        $users = $this->factory->all();
        return new UserCollection($users);
    }

    public function update(User $user)
    {
        return $this->factory->update($user);
    }

    public function store(User $user)
    {
        $user->id = $this->factory->store($user);
        Event::fire(new UserCreated($user));
        return $user;
    }

    public function addRoles($userId, $userRoles)
    {
        $this->factory->addRoles($userId, $userRoles);
        Event::fire(new UserRolesChanged($userId));
        return $userId;
    }

    public function delete(User $user)
    {
        return $this->factory->delete($user);
    }

    public function approveAgent(User $user)
    {
        $user->trustedAgent = 1;
        $this->factory->approveAgent($user);
        Event::fire(new UpdateAgentStatus($user));
    }
    public function userWasAgent($userId)
    {
        $userRoles = (new RolesRepoProvider())->repo()->getUserRoles($userId);
        $userRolesIds = Helper::propertyToArray($userRoles, 'id');
        return (in_array($this->idForAgentBroker, $userRolesIds))?true:false;
    }
}
