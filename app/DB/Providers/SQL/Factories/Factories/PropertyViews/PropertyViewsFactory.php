<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:34 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyViews;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Factories\Factories\PropertyViews\Gateways\PropertyViewsQueryBuilder;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\PropertyViews;

class PropertyViewsFactory extends SQLFactory implements SQLFactoriesInterface{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyViews();
        $this->tableGateway = new PropertyViewsQueryBuilder();
    }
    public function incrementViews($propertyIds)
    {
        return $this->tableGateway->incrementViews($propertyIds);
    }
    public function insertMultiple(array $propertiesViews)
    {
        $addPropertiesViews =[];
        foreach($propertiesViews  as $propertiesView)
        {
            $addPropertiesViews[] = $this->mapPropertyViewsOnTable($propertiesView);
        }
        return $this->tableGateway->insertMultiple($addPropertiesViews);
    }
    public function all(){}
    public function find($id){}
    public function map($result)
    {
        $agency = clone($this->model);
        $agency->propertyId = $result->property_id;
        $agency->ipAddress = $result->ip_address;
        $agency->createdAt = $result->created_at;
        $agency->updatedAt = $result->updated_at;
        return $agency;
    }

    /**
     * @param PropertyViews $propertyViews
     * @return array
     **/
    private function mapPropertyViewsOnTable(PropertyViews $propertyViews)
    {
        return [
            'ip_address' => $propertyViews->ipAddress,
            'property_id' => $propertyViews->propertyId,
            'updated_at' => $propertyViews->updatedAt,
            'created_at' => $propertyViews->createdAt,
        ];
    }
}
