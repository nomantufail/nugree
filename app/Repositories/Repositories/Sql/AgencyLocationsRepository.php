<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\AgencyLocation\AgencyLocationFactory;
use App\DB\Providers\SQL\Models\AgencyLocation;
use App\Events\Events\Agency\AgencyUpdated;
use App\Libs\Helpers\Helper;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use Illuminate\Support\Facades\Event;

class AgencyLocationsRepository extends SqlRepository implements AgenciesRepoInterface
{
    private $factory = null;
    public function __construct(){
        $this->factory = new AgencyLocationFactory();
    }

    public function update($agencyId, array $locationIds)
    {
        $existingAgencyIds = Helper::propertyToArray($this->get($agencyId),'locationId');
        $newLocationIds = array_diff($locationIds,$existingAgencyIds);
        $deletingLocationIds = array_diff($existingAgencyIds,$locationIds);
        $newLocationModels = [];
        foreach($newLocationIds as $newLocationId)
        {
            $agencyLocation = new AgencyLocation();
            $agencyLocation->agencyId = $agencyId;
            $agencyLocation->locationId = $newLocationId;
            $newLocationModels[] = $agencyLocation;
        }
        $this->storeMultiple($newLocationModels);
        $this->deleteAgencyLocations($agencyId, $deletingLocationIds);
        Event::fire(new AgencyUpdated((new AgenciesRepoProvider())->repo()->getById($agencyId)));
    }

    public function storeMultiple(array $agencyLocations)
    {
        return $this->factory->addLocation($agencyLocations);
    }

    public function deleteAgencyLocations($agencyId, array $locationIds)
    {
        $this->factory->deleteAgencyLocations($agencyId, $locationIds);
    }

    public function get($agencyId)
    {
        return $this->factory->get($agencyId);
    }
}
