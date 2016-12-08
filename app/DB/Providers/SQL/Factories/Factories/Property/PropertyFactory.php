<?php

namespace App\DB\Providers\SQL\Factories\Factories\Property;

/**
 * Created by PhpStorm.
 * User: noman
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\Property\Gateways\PropertyQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;

use App\DB\Providers\SQL\Models\AddToFavourite;
use App\DB\Providers\SQL\Models\Block;
use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Country;
use App\DB\Providers\SQL\Models\FavouriteProperty;
use App\DB\Providers\SQL\Models\Location;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\Property\PropertyCompleteLocation;
use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\DB\Providers\SQL\Models\PropertyStatus;
use App\DB\Providers\SQL\Models\PropertyType;
use App\DB\Providers\SQL\Models\Society;
use App\Repositories\Providers\Providers\PropertyPurposesRepoProvider;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;

class PropertyFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    private $statusesSeeder =null;
    public function __construct()
    {
        $this->model = new PropertyType();
        $this->tableGateway = new PropertyQueryBuilder();
        $this->statusesSeeder = new \PropertyStatusTableSeeder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function delete(Property $property)
    {
        $property->statusId = $this->statusesSeeder->getDeletedStatusId();
        return $this->tableGateway->updateWhere(['id'=>$property->id],$this->mapPropertyOnTable($property));
    }
    public function getPropertyBySlug($propertySlug)
    {
        return $this->tableGateway->findBy('slug',$propertySlug);
    }
    public function countSaleAndRendProperties()
    {
      return $this->tableGateway->countSaleAndRendProperties();
    }
    public function IncrementViews($propertyId)
    {
        return $this->tableGateway->IncrementViews($propertyId);
    }
    public function deleteByIds(array $propertyIds)
    {
        return $this->tableGateway->deleteByIds($propertyIds);
    }
    public function forceDeleteByIds($propertyIds)
    {
        return $this->tableGateway->forceDeleteByIds($propertyIds);
    }
    public function forceDelete(Property $property)
    {
        return $this->tableGateway->delete($property->id);
    }

    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function update(Property $property)
    {
        return $this->tableGateway->update($property->id,$this->mapPropertyOnTable($property));
    }
   public function store(Property $property)
    {
        $property->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyOnTable($property));
    }

    public function getCompleteLocation($propertyId)
    {
        return $this->mapPropertyCompleteLocation($this->tableGateway->getCompleteLocation($propertyId));
    }
    public function userPropertiesState($userId)
    {
        $records = $this->tableGateway->userPropertiesState($userId);
        $collection  = collect($records);
        $result = $collection->groupBy('purpose');
        return $result->toArray();
    }
    public function favourites($userId)
    {
        return $this->mapCollection($this->tableGateway->getFavourites($userId));
    }

    private function mapPropertyCompleteLocation($rawLocation)
    {
        $propertyCompleteLocation = new PropertyCompleteLocation();

        $country = new Country();
        $country->id = $rawLocation->countryId;
        $country->name = $rawLocation->countryName;

        $city = new City();
        $city->id = $rawLocation->cityId;
        $city->name = $rawLocation->cityName;
        $city->countryId = $rawLocation->countryId;

//        $society = new Society();
//        $society->id = $rawLocation->societyId;
//        $society->name = $rawLocation->societyName;
//        $society->cityId = $rawLocation->cityId;

        $location = new Location();
        $location->id = $rawLocation->locationId;
        $location->location = $rawLocation->locationName;
        $location->cityId = $rawLocation->cityId;
        $location->lat = $rawLocation->lat;
        $location->long = $rawLocation->long;

        $propertyCompleteLocation->country = $country;
        $propertyCompleteLocation->city = $city;
        //$propertyCompleteLocation->society = $society;
        $propertyCompleteLocation->location = $location;

        return $propertyCompleteLocation;
    }

    private function mapPropertyOnTable(Property $property)
    {
        return [
            'Id'=>$property->id,
            'purpose_id'=>$property->purposeId,
            'property_sub_type_id' => $property->subTypeId,
            'location_id' => $property->locationId,
            'title' => $property->title,
            'description' => $property->description,
            'price' => $property->price,
            'land_area' => $property->landArea,
            'land_unit_id' => $property->landUnitId,
            'property_status_id' => $property->statusId,
            'contact_person' => $property->contactPerson,
            'phone' => $property->phone,
            'wanted'=>$property->wanted,
            'mobile' => $property->mobile,
            'fax' => $property->fax,
            'email' => $property->email,
            'is_verified'=>$property->isVerified,
            'owner_id'=>$property->ownerId,
            'slug'=>$property->slug,
            'created_by'=>$property->createdBy,
            'created_at' => $property->createdAt,
            'updated_at' => $property->updatedAt
        ];
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $property            = new Property();
        $property->id        = $result->id;

        $property->purposeId = $result->purpose_id;
        $property->subTypeId =  $result->property_sub_type_id;
        $property->locationId =  $result->location_id;
        $property->title =  $result->title;
        $property->description =  $result->description;
        $property->price =  $result->price;
        $property->landArea =  $result->land_area;
        $property->landUnitId =  $result->land_unit_id;

        $property->contactPerson =  $result->contact_person;
        $property->phone =  $result->phone;
        $property->mobile =  $result->mobile;
        $property->fax =  $result->fax;
        $property->email =  $result->email;
        if(isset($result->wanted))
            $property->wanted = $result->wanted;
        $property->ownerId = $result->owner_id;

        $property->statusId = $result->property_status_id;
        $property->totalViews = $result->total_views;
        $property->totalLikes = $result->total_likes;
        $property->ratings = $result->rating;
        $property->slug = $result->slug;

        $property->createdBy = $result->created_by;

        $property->createdAt = $result->created_at;
        $property->updatedAt = $result->updated_at;

        return $property;
    }

    public function getTable()
    {
        return $this->tableGateway->getTable();
    }

    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }

    public function rawPropertyCounts($userId)
    {
        $propertyCounts = $this->tableGateway->countProperties($userId);
        $propertyCountsCollection = collect($propertyCounts);
        $groupedByPurpose = $propertyCountsCollection->groupBy('purpose_id');
        $finalArray = [];
        $groupedByPurpose->each(function($item, $key) use (&$finalArray){
            $statusesCounts = [];
            $item->each(function($status, $key) use (&$statusesCounts){
                $statusesCounts[$status->property_status_id] = $status->totalPropertiesByStatus;
            });
            $finalArray[$key] = $statusesCounts;
        });
        return $finalArray;
    }

    public function propertiesCounter($propertyCounts, $purpose, $status)
    {
        if(isset($propertyCounts[$purpose][$status])){
            return intval($propertyCounts[$purpose][$status]);
        }else{
            return 0;
        }
    }

    public function countProperties($userId)
    {
        $rawPropertyCounts = $this->rawPropertyCounts($userId);
        $purposes = (new PropertyPurposesRepoProvider())->repo()->all();
        $statuses = (new PropertyStatusesRepoProvider())->repo()->all();

        $finalCounts = [];
        foreach($purposes as $purpose /* @var $purpose PropertyPurpose::class */)
        {
            $pStatuses = [];
            foreach($statuses as $status /* @var $status PropertyStatus::class */)
            {
                $pStatuses[$status->id] = $this->propertiesCounter($rawPropertyCounts,$purpose->id, $status->id);
            }
            $finalCounts[$purpose->id] = $pStatuses;
        }
        return $finalCounts;
    }
}