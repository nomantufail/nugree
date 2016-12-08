<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Location;

use App\DB\Providers\SQL\Models\Location;
use App\DB\Providers\SQL\Models\Property\PropertyCompleteLocation;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyLocationJsonPrototype;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\CountriesRepoProvider;

class PropertyLocationJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    protected $citiesRepository = null;
    protected $countriesRepository = null;

    protected $location = null;
    protected $city = null;
    protected $country = null;

    public function __construct(Location $location = null)
    {
        $this->prototype = new PropertyLocationJsonPrototype();
        $this->citiesRepository = (new CitiesRepoProvider())->repo();
        $this->countriesRepository = (new CountriesRepoProvider())->repo();
        $this->location = $location;
        $this->city = $this->citiesRepository->getById($this->location->cityId);
        $this->country = $this->countriesRepository->getById($this->city->countryId);
    }

    public function create()
    {
        $this->prototype->country = $this->getCountry();
        $this->prototype->city = $this->getCity();
        $this->prototype->location = $this->getLocation();
        return $this->prototype;
    }

    private function getLocation()
    {
        return (new PropertySubLocationJsonCreator($this->location))->create();
    }
    private function getCity()
    {
        return (new PropertyCityJsonCreator($this->city))->create();
    }
    private function getCountry()
    {
        return (new PropertyCountryJsonCreator($this->country))->create();
    }
}