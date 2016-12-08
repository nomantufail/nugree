<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Owner;

use App\DB\Providers\SQL\Models\User;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Owner\PropertyOwnerJsonPrototype;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\UserRolesRepoProvider;
use App\Repositories\Repositories\Sql\AgenciesRepository;

class PropertyOwnerJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $agenciesRepository = null;
    private $userRole = null;
    public function __construct(User $owner = null)
    {
        $this->model = $owner;
        $this->prototype = new PropertyOwnerJsonPrototype();
        $this->agenciesRepository  = new AgenciesRepository();
        $this->userRole = (new RolesRepoProvider())->repo();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->address = $this->model->address;
        $this->prototype->email = $this->model->email;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->fName = $this->model->fName;
        $this->prototype->lName = $this->model->lName;
        $this->prototype->phone = $this->model->phone;
        $this->prototype->isTrusted = $this->model->trustedAgent;
        $this->prototype->isAgent = $this->getUserRole();
        $this->prototype->agency = $this->getAgency();

        return $this->prototype;
    }

    private function getUserRole()
    {
      $userRoles = $this->userRole->getUserRoles($this->model->id);

        foreach($userRoles as $userRole)
        {
            if($userRole->id == 3)
            {
                return 1;
            }

        }
        return 0;
    }

    private function getAgency()
    {
        $agencies = $this->agenciesRepository->getByUser($this->model->id);
        if(count($agencies) == 0)
            return null;

        $agency = $agencies[0];
        return (new AgencyJsonCreator($agency))->create();
    }
}