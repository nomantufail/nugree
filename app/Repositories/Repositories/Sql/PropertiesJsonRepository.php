<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Libs\SearchEngines\Properties\SearchEngineProvider;
use App\Repositories\Interfaces\Repositories\PropertiesJsonRepoInterface;

class PropertiesJsonRepository extends SqlRepository implements PropertiesJsonRepoInterface
{
    private $userJsonTransformer;
    private $factory = null;
    private $cheetah = null;
    private $propertyStatus = null;
    public function __construct(){
        $this->userJsonTransformer = null;
        $this->factory = new PropertyJsonFactory();
        $this->cheetah = (new SearchEngineProvider())->cheetah();
        $this->propertyStatus =  new \PropertyStatusTableSeeder();
    }

    public function getPropertyBySlug($slug)
    {
        return $this->factory->getPropertyBySlug($slug);
    }

    public function all()
    {
        return $this->factory->all();
    }
    public function wantedProperties($params)
    {
        return $this->factory->wantedProperties($params);
    }
    public function propertyCount()
    {
        return $this->factory->propertyCount();
    }

    public function search(array $instructions)
    {
        return $this->factory->search($instructions);
    }
    public function getAllProperties()
    {
        return $this->factory->getAllProperties();
    }
    public function getActiveProperties()
    {
        return $this->factory->getActiveProperties($this->propertyStatus->getActiveStatusId());
    }
    public function getPendingProperties()
    {
        return $this->factory->getPendingProperties($this->propertyStatus->getPendingStatusId());
    }
    public function getExpiredProperties()
    {
        return $this->factory->getExpiredProperties($this->propertyStatus->getExpiredStatusId());
    }
    public function getRejectedProperties()
    {
        return $this->factory->getRejectedProperties($this->propertyStatus->getRejectedStatusId());
    }
    public function getDeletedProperties()
    {
        return $this->factory->getDeletedProperties($this->propertyStatus->getDeletedStatusId());
    }
    public function find($id)
    {
        return $this->factory->find($id);
    }
    public function getFavouriteProperties($params)
    {
        return $this->factory->getFavouriteProperties($params);
    }
    public function store(PropertyJsonPrototype $property)
    {
        return $this->factory->store($property);
    }

    public function update($property)
    {
        return $this->factory->update($property);
    }

    public function delete($id)
    {
        return $this->factory->delete($id);
    }
    public function getUserProperties($params)
    {
        return $this->factory->getUserProperties($params);
    }
    public function countSearchedUserProperties($params)
    {
        return $this->factory->countSearchedUserProperties($params);
    }
    public function getById($propertyId)
    {
        return $this->factory->getById($propertyId);
    }
    public function getByIds(array $propertyIds)
    {
        return $this->factory->getByIds($propertyIds);
    }
    public function getAgencyProperties($agencyId)
    {
        return $this->factory->getAgencyProperties($agencyId);
    }
    public function updateMultipleByIds($properties)
    {
        foreach($properties as $property)
        {
            $this->update($property);
        }
        return true;
    }
}
