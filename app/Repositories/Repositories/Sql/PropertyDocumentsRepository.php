<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;

use App\DB\Providers\SQL\Factories\Factories\PropertyDocument\PropertyDocumentFactory;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Repositories\Interfaces\Repositories\AgenciesRepoInterface;

class PropertyDocumentsRepository extends SqlRepository implements AgenciesRepoInterface
{
    private $factory;


    public function __construct()
    {
        $this->factory = new PropertyDocumentFactory();
    }

    /**
     * @param array $propertyDocuments
     * @return mixed
     */
    public function storeMultiple(array $propertyDocuments)
    {
        return $this->factory->storeMultiple($propertyDocuments);
    }

    /**
     * @param PropertyDocument $propertyDocument
     * @return mixed
     */
    public function store(PropertyDocument $propertyDocument)
    {
        return $this->factory->store($propertyDocument);
    }

    /**
     * @param PropertyDocument $propertyDocument
     * @return mixed
     */
    public function update(propertyDocument $propertyDocument)
    {
        return $this->factory->update($propertyDocument);
    }

    /**
     * @param $propertyId
     * @return mixed
     */
    public function deleteByProperty($propertyId)
    {
        return $this->factory->deleteByProperty($propertyId);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        return $this->factory->deleteByIds($ids);
    }

    /**
     * @param PropertyDocument $propertyDocument
     * @return mixed
     */
    public function delete(propertyDocument $propertyDocument)
    {
        return $this->factory->delete($propertyDocument);
    }

    /**
     * @param int $propertyId
     * @return mixed
     */
    public function getByProperty($propertyId)
    {
        return $this->factory->getByProperty($propertyId);
    }

    /**
     * @param PropertyDocument $propertyDocument
     * @return mixed
     */
    public function getById(propertyDocument $propertyDocument)
    {
        return $this->factory->getBId($propertyDocument);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function getByIds(array $ids)
    {
        return $this->factory->getByIds($ids);
    }

    /**
     * @param PropertyDocument $propertyDocument
     * @return PropertyDocument|null
     */
    public function find(propertyDocument $propertyDocument)
    {
        return $this->factory->find($propertyDocument);
    }
    public function all()
    {
        return $this->factory->all();
    }
}
