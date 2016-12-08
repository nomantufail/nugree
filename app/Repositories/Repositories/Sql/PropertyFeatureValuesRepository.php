<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\PropertyFeatureValue\PropertyFeatureValueFactory;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\Repositories\Interfaces\Repositories\FeaturesRepoInterface;


class PropertyFeatureValuesRepository extends SqlRepository implements FeaturesRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PropertyFeatureValueFactory();
    }

    public function store(PropertyFeatureValue $feature)
    {
        return $this->factory->store($feature);
    }

    public function storeMultiple(array $featureValues)
    {
        return $this->factory->storeMultiple($featureValues);
    }

    public function updatePropertyFeatures($propertyId, array $features)
    {
        $this->deletePropertyFeatures($propertyId);
        return $this->storeMultiple($features);
    }

    public function deletePropertyFeatures($propertyId)
    {
        return $this->factory->deletePropertyFeatures($propertyId);
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function getBySubType($subTypeId)
    {
        return $this->factory->getBySubType($subTypeId);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(PropertyFeatureValue $feature)
    {
        $this->factory->update($feature);
        return $this->factory->find($feature->id);
    }

    public function delete(PropertyFeatureValue $feature)
    {
        return $this->factory->delete($feature);
    }
//    public function getBySociety($id)
//    {
//        return $this->factory->getBySociety($id);
//    }
}