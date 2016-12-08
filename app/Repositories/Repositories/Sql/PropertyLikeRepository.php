<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\PropertyLike\PropertyLikeFactory;
use App\DB\Providers\SQL\Models\PropertyLike;
use App\Repositories\Interfaces\Repositories\FeatureSectionRepoInterface;


class PropertyLikeRepository extends SqlRepository implements FeatureSectionRepoInterface
{
    private $factory;

    public function __construct()
    {
         $this->factory = new PropertyLikeFactory();
    }

    public function store(PropertyLike $propertyLike)
    {
        return $this->factory->store($propertyLike);
    }
    public function getTotalLikes(PropertyLike $propertyLike)
    {
        return $this->factory->getTotalLikes($propertyLike);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(PropertyLike $propertyLike)
    {
        $this->factory->update($propertyLike);
        return $this->factory->find($propertyLike->id);
    }

    public function delete(PropertyLike $propertyLike)
    {
        return $this->factory->delete($propertyLike);
    }
    public function getById($id)
    {
        return $this->factory->getById($id);
    }

}