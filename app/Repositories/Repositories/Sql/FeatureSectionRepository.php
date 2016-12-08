<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\FeatureSection\FeatureSectionFactory;
use App\DB\Providers\SQL\Models\FeatureSection;
use App\Repositories\Interfaces\Repositories\FeatureSectionRepoInterface;


class FeatureSectionRepository extends SqlRepository implements FeatureSectionRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new FeatureSectionFactory();
    }
    public function store(FeatureSection $featureSection)
    {
        return $this->factory->store($featureSection);
    }


    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(FeatureSection $featureSection)
    {
        $this->factory->update($featureSection);
        return $this->factory->find($featureSection->id);
    }

    public function delete(FeatureSection $featureSection)
    {
        return $this->factory->delete($featureSection);
    }
//    public function getBySociety($id)
//    {
//        return $this->factory->getBySociety($id);
//    }
}