<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertySubType\PropertySubTypeFactory;
use App\DB\Providers\SQL\Models\FavouriteProperty;
use App\DB\Providers\SQL\Models\Property;

use App\Events\Events\Property\PropertiesStatusChanged;


use App\Events\Events\Property\PropertyDEVerified;
use App\Events\Events\Property\PropertyStatusUpdated;

use App\Events\Events\Property\PropertyVerified;
use App\Events\Events\Property\UpdatePropertyTotalView;
use App\Repositories\Interfaces\Repositories\PropertyTypeRepoInterface;
use Illuminate\Support\Facades\Event;


class PropertiesRepository extends SqlRepository implements PropertyTypeRepoInterface
{
    private $factory;
    private $propertySubTypeFactory;
    private $favouriteFactory;

    public function __construct()
    {
        $this->factory = new PropertyFactory();
        $this->favouriteFactory = new FavouritePropertyFactory();
        $this->propertySubTypeFactory = new PropertySubTypeFactory();
    }

    public function store(Property $property)
    {
        $propertyId = $this->factory->store($property);
        $property->id = $propertyId;
        return $propertyId;
    }
    public function getPropertyBySlug($propertySlug)
    {
        return $this->factory->getPropertyBySlug($propertySlug);
    }
    public function countSaleAndRendProperties()
    {
        return $this->factory->countSaleAndRendProperties();
    }

    public function IncrementViews($propertyId)
    {
        $this->factory->IncrementViews($propertyId);
        Event::fire(new UpdatePropertyTotalView($this->factory->find($propertyId)));
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function favourites($userId)
    {
        return $this->factory->favourites($userId);
    }
    public function restoreProperty(Property $property)
    {
        $property->statusId=(new \PropertyStatusTableSeeder())->getActiveStatusId();
        $result = $this->factory->update($property);
        Event::fire(new PropertyStatusUpdated($property));
        return $result;
    }
    public function rejectProperty(Property $property)
    {
        $property->statusId=(new \PropertyStatusTableSeeder())->getRejectedStatusId();
        $result = $this->factory->update($property);
        Event::fire(new PropertyStatusUpdated($property));
        return $result;
    }
    public function VerifyProperty(Property $property)
    {
        $property->isVerified = 1;
        $result = $this->factory->update($property);
        Event::fire(new PropertyVerified($property));
        return $result;
    }
    public function deVerifyProperty(Property $property)
    {
        $property->isVerified = 0;
        $result = $this->factory->update($property);
        Event::fire(new PropertyDEVerified($property));
        return $result;
    }
    public function approveProperty(Property $property)
    {
        $property->statusId=(new \PropertyStatusTableSeeder())->getActiveStatusId();
        $result = $this->factory->update($property);
        Event::fire(new PropertyStatusUpdated($property));
        return $result;
    }
    public function deActiveProperty(Property $property)
    {
        $property->statusId=(new \PropertyStatusTableSeeder())->getPendingStatusId();
        $result = $this->factory->update($property);
        Event::fire(new PropertyStatusUpdated($property));
        return $result;
    }
    public function all()
    {
        return $this->factory->all();
    }

    public function propertyCompleteType($propertyId)
    {
        return $this->propertySubTypeFactory->propertyCompleteType($propertyId);
    }

    public function update(Property $property)
    {
      return $this->factory->update($property);
    }

    public function delete(Property $property)
    {
        return  $this->factory->delete($property);
    }

    public function deleteByIds(array $propertyIds)
    {
        $result = $this->factory->deleteByIds($propertyIds);
        Event::fire(new PropertiesStatusChanged($propertyIds, (new \PropertyStatusTableSeeder())->getDeletedStatusId()));
        return $result;
    }
    public function deleteFavouriteProperty($params)
    {
        return  $this->favouriteFactory->deleteFavouriteProperty($params);
    }
    public function multiDeleteFavouriteProperty($propertyIds,$userId)
    {
        return  $this->favouriteFactory->multiDeleteFavouriteProperty($propertyIds,$userId);
    }
    public function forceDeleteByIds($propertyIds)
    {
        return $this->factory->forceDeleteByIds($propertyIds);
    }
    public function forceDelete(Property $property)
    {
        return  $this->factory->forceDelete($property);
    }
    public function getCompleteLocation($id)
    {
        return $this->factory->getCompleteLocation($id);
    }
    public function countProperties($userId)
    {
        return $this->factory->countProperties($userId);
    }
    public function favouriteProperty(FavouriteProperty $addToFavourite)
    {
        return $this->favouriteFactory->store($addToFavourite);
    }
    public function userPropertiesState($userId)
    {
        return $this->factory->userPropertiesState($userId);
    }

}