<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\User;

use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Creators\Property\Location\PropertyLocationJsonCreator;
use App\Libs\Json\Creators\Creators\Property\Location\PropertySocietyJsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertySocietyJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\User\AgencyJsonPrototype;
use App\DB\Providers\SQL\Models\Agency;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;

class AgencyJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(Agency $agency = null)
    {
        $this->model = $agency;
        $this->prototype = new AgencyJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->address = $this->model->address;
        $this->prototype->description  = $this->model->description;
        $this->prototype->email = $this->model->email;
        $this->prototype->mobile = $this->model->mobile;
        $this->prototype->name = $this->model->name;
        $this->prototype->phone = $this->model->phone;
        $this->prototype->logo = $this->model->logo;
        $this->prototype->slug = $this->model->slug;
        $this->prototype->locations = $this->getLocation();
        return $this->prototype;
    }

    public function getSocieties()
    {
        $societies = (new SocietiesRepoProvider())->repo()->getSocietiesByAgency($this->model->id);
        $finalResult= [];
        foreach($societies as $society)
        {
           $finalResult[] =  (new PropertySocietyJsonCreator($society))->create();
        }
        return $finalResult;
    }


    public function getLocation()
    {
        $locations = (new LocationsRepoProvider())->repo()->getLocationsByAgency($this->model->id);
        $finalResult= [];
        foreach($locations as $location)
        {
            $finalResult[] =  (new PropertyLocationJsonCreator($location))->create();
        }
        return $finalResult;
    }
}