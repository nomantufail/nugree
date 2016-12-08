<?php

namespace App\DB\Providers\SQL\Factories\Factories\Location;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */


use App\DB\Providers\SQL\Factories\Factories\Location\Gateways\LocationQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\DetailLocation;
use App\DB\Providers\SQL\Models\Location;

class LocationFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Location();
        $this->detailLocation = new DetailLocation();
        $this->tableGateway = new LocationQueryBuilder();
    }

    function first()
    {
        return $this->tableGateway->first();
    }
    /**
     * @param $id
     * @return Location|null
     */
    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function getLocationBySlug($locationSlug)
    {
        return $this->tableGateway->findBy('slug',$locationSlug);
    }
    public function getByIds($ids)
    {
        return $this->mapCollection($this->tableGateway->getWhereIn('id',$ids));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function getLocationByCity($params)
    {
        return $this->mapCollection($this->tableGateway->getLocationByCity($params));

    }
    public function getByCity($params)
    {
        $locations = $this->tableGateway->getByCity($params);
        $final =[];
        foreach($locations as $location)
        {
            $final[] = $this->detailMap($location);
        }
        return $final;
    }
    public function search($params)
    {
        return $this->mapCollection($this->tableGateway->search($params));
    }
    public function update(Location $location)
    {
        $location->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($location->id ,$this->mapPropertyTypeOnTable($location));
    }
    public function getCityLocationCount($cityId)
    {
        return $this->tableGateway->getCityLocationCount($cityId);
    }
    public function locationCount()
    {
        return $this->tableGateway->locationCount();
    }
    public function store(Location $location)
    {
        $location->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyTypeOnTable($location));
    }
    public function delete(Location $location)
    {
        return $this->tableGateway->delete($location->id);
    }
    public function getLocationsByAgency($agencyId)
    {
        return $this->mapCollection($this->tableGateway->getLocationsByAgency($agencyId));
    }
    private function mapPropertyTypeOnTable(Location $location)
    {
        return [
            'city_id'=>$location->cityId,
            'location'=>$location->location,
            'lat'=>$location->lat,
            'long'=>$location->long,
            'title'=>$location->title,
            'keyword'=>$location->keyword,
            'description'=>$location->description,
            'slug'=>$location->slug,
            'index'=>$location->index,
            'updated_at' => $location->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function detailMap($result)
    {
        $location = clone($this->detailLocation);
        $location->id=$result->id;
        $location->cityId = $result->city_id;
        $location->location = $result->location;
        $location->lat = $result->lat;
        $location->long = $result->long;
        $location->title      = $result->title;
        $location->keyword      = $result->keyword;
        $location->description      = $result->description;
        $location->index      = $result->index;
        $location->slug = $result->slug;
        $location->totalProperties = $result->totalProperties;
        $location->createdAt = $result->created_at;
        $location->updatedAt = $result->updated_at;
        return $location;
    }

    /**
     * @param $result
     * @return Location
     */
    function map($result)
    {
        $location = clone($this->model);
        $location->id = $result->id;
        $location->cityId = $result->city_id;
        $location->location = $result->location;
        $location->lat = $result->lat;
        $location->long = $result->long;
        $location->title      = $result->title;
        $location->keyword      = $result->keyword;
        $location->description      = $result->description;
        $location->index      = $result->index;
        $location->slug = $result->slug;
        $location->createdAt = $result->created_at;
        $location->updatedAt = $result->updated_at;
        return $location;
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}