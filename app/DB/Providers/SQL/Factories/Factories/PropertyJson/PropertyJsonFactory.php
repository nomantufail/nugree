<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson;

use App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\PropertyJsonQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\LandUnit;
use App\Libs\Helpers\LandArea;
use App\Libs\Json\Creators\Creators\Property\Land\PropertyLandUnitJsonCreator;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\Models\Sql\PropertyJson;

class PropertyJsonFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyJsonPrototype();
        $this->tableGateway = new PropertyJsonQueryBuilder();
    }

    /**
     * @return array UserModel::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function wantedProperties($params)
    {
        return $this->mapCollection($this->tableGateway->wantedProperties($params));
    }
    public function propertyCount()
    {
        return $this->tableGateway->propertyCount();
    }
    public function getAgencyProperties($agencyId)
    {
        return $this->mapCollection($this->tableGateway->getAgencyProperties($agencyId));
    }
    public function getFavouriteProperties($params)
    {
        return $this->mapCollection($this->tableGateway->getFavouriteProperties($params));
    }
    public function countFavouriteProperties($userId)
    {
        return $this->tableGateway->countFavouriteProperties($userId);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    public function getAllProperties()
    {
        return $this->mapCollection($this->tableGateway->all());
    }
    public function getActiveProperties($propertyActiveStatus)
    {
        return $this->mapCollection($this->tableGateway->getPropertiesByStatuses($propertyActiveStatus));
    }
    public function getPendingProperties($propertyPendingStatus)
    {
        return $this->mapCollection($this->tableGateway->getPropertiesByStatuses($propertyPendingStatus));
    }
    public function getExpiredProperties($propertyExpiredStatus)
    {
        return $this->mapCollection($this->tableGateway->getPropertiesByStatuses($propertyExpiredStatus));
    }
    public function getRejectedProperties($propertyRejectedStatus)
    {
        return $this->mapCollection($this->tableGateway->getPropertiesByStatuses($propertyRejectedStatus));
    }
    public function getDeletedProperties($propertyDeletedStatus)
    {
        return $this->mapCollection($this->tableGateway->getPropertiesByStatuses($propertyDeletedStatus));
    }
    public function updateMultipleByIds($properties)
    {
        return $this->tableGateway->updateMultipleByIds($properties);
    }
    /**
     * @param int $id
     * @return UserJsonPrototype::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->findByUser($id));
    }
    public function getById($propertyId)
    {
        return $this->map($this->tableGateway->findBy('property_id', $propertyId));
    }
    public function getPropertyBySlug($slug)
    {
        return $this->map($this->tableGateway->findBySlug($slug));
    }

    public function getByIds(array $propertyIds)
    {
        return $this->mapCollection($this->tableGateway->getWhereIn('property_id', $propertyIds));
    }
    public function delete($id)
    {
        return $this->tableGateway->deleteWhere(['property_id'=>$id]);
    }

    public function search(array $params)
    {
        $properties = $this->mapCollection($this->tableGateway->search($params));
        return $this->transformLandUnits($properties, $params);
    }

    private function transformLandUnits(array $properties, $params)
    {
        if(!isset($params['landUnitId']) || $params['landUnitId'] == null){
            $params['landUnitId'] = 3;
        }

        $landUnit = new LandUnit();
        $landUnit->id = $params['landUnitId'];
        $landUnit->name = config('constants.LAND_UNITS')[$params['landUnitId']];
        $landUnit = (new PropertyLandUnitJsonCreator($landUnit))->create();

        foreach($properties as &$property /* @var $property PropertyJsonPrototype*/){
            $property->land->area =  LandArea::convert('square feet', $landUnit->name, $property->land->area);
            $property->land->unit = $landUnit;
        }

        return $properties;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getUserProperties($params)
    {
        return $this->mapCollection($this->tableGateway->getUserProperties($params));
    }
    public function countSearchedUserProperties($params)
    {
         return $this->tableGateway->countSearchedUserProperties($params);
    }

    /**
     * @param PropertyJsonPrototype $property
     * @return bool
     **/
    public function update(PropertyJsonPrototype $property)
    {
        return $this->tableGateway->updateWhere(['property_id'=>$property->id], $this->mapPropertyOnTable($property));
    }

    /**
     * @param PropertyJsonPrototype $property
     * @return int
     **/
    public function store(PropertyJsonPrototype $property)
    {
        return $this->tableGateway->insert($this->mapPropertyOnTable($property));
    }

    /**
     * @param $result
     * @return PropertyJsonPrototype::class
     **/
    public function map($result)
    {
        /* @var $propertyJson PropertyJsonPrototype::class */
        $propertyJson = json_decode($result->json);
        $property = clone($this->model);

        $property->id = $propertyJson->id;
        $property->owner = $propertyJson->owner;
        $property->type = $propertyJson->type;
        $property->totalViews = $propertyJson->totalViews;
        $property->totalLikes = $propertyJson->totalLikes;
        $property->title = $propertyJson->title;
        $property->rating = $propertyJson->rating;
        $property->purpose = $propertyJson->purpose;
        $property->propertyStatus = $propertyJson->propertyStatus;
        $property->price = $propertyJson->price;
        $property->location = $propertyJson->location;
        $property->isHot = $propertyJson->isHot;
        $property->land = $propertyJson->land;
        $property->isFeatured = $propertyJson->isFeatured;
        if(isset($propertyJson->wanted))
            $property->wanted = $propertyJson->wanted;
        $property->isDeleted = $propertyJson->isDeleted;
        $property->features = $propertyJson->features;
        $property->description = $propertyJson->description;
        $property->documents = $propertyJson->documents;
        $property->contactPerson = $propertyJson->contactPerson;
        $property->email = $propertyJson->email;
        $property->phone = $propertyJson->phone;
        $property->mobile = $propertyJson->mobile;
        $property->slug = (isset($propertyJson->slug)?$propertyJson->slug: "");
        $property->isVerified = (isset($propertyJson->isVerified)?$propertyJson->isVerified: 0);
        $property->fax = $propertyJson->fax;
        $property->createdBy = $propertyJson->createdBy;
        $property->createdAt = $propertyJson->createdAt;
        return $property;
    }

    /**
     * @param PropertyJsonPrototype $property
     * @return array
     */
    private function mapPropertyOnTable(PropertyJsonPrototype $property)
    {
        return [
            'property_id' => $property->id,
            'json' => $property->encode(),
        ];
    }
}
