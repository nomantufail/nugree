<?php

namespace App\DB\Providers\SQL\Factories\Factories\PropertyDocument;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */

use App\DB\Providers\SQL\Factories\Factories\PropertyDocument\Gateways\PropertyDocumentQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\PropertyDocument;

class PropertyDocumentFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new PropertyDocument();
        $this->tableGateway = new PropertyDocumentQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    public function update(propertyDocument $document)
    {
        $document->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($document->id ,$this->mapPropertyDocumentOnTable($document));
    }

    public function store(propertyDocument $document)
    {
        $document->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapPropertyDocumentsOnTable($document));
    }

    public function delete(propertyDocument $document)
    {
        return $this->tableGateway->delete($document->id);
    }

    public function deleteByIds(array $ids)
    {
        return $this->tableGateway->deleteWhereIn('id', $ids);
    }

    public function getBId(propertyDocument $document)
    {
        return $this->tableGateway->find($document->id);
    }

    public function getByIds(array $ids)
    {
        return $this->mapCollection($this->tableGateway->getWhereIn('id', $ids));
    }

    public function storeMultiple(array $propertyDocuments)
    {
        return $this->tableGateway->insertMultiple($this->mapPropertyDocumentsOnTable($propertyDocuments));
    }

    public function deleteByProperty($propertyId)
    {
        return $this->tableGateway->deleteWhere(['property_id'=>$propertyId]);
    }
    public function getByProperty($propertyId)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['property_id'=>$propertyId]));
    }

    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    private function mapPropertyDocumentsOnTable(array $documents)
    {
        $finalDocuments = [];
        foreach($documents as $document /* @var $document PropertyDocument::class*/)
        {
            $finalDocuments[] = $this->mapPropertyDocumentOnTable($document);
        }
        return $finalDocuments;
    }
    private function mapPropertyDocumentOnTable(propertyDocument $document)
    {
        return [
            'property_id' => $document->propertyId,
            'type'=>$document->type,
            'path'=>$document->path,
            'title' => $document->title,
            'main' => $document->main,
            'updated_at' => $document->updatedAt,
        ];
    }

   function map($result)
    {
        $document  = new propertyDocument();
        $document->id = $result->id;
        $document->propertyId = $result->property_id;
        $document->type = $result->type;
        $document->path = $result->path;
        $document->title = $result->title;
        $document->main = $result->main;
        $document->createdAt = $result->created_at;
        $document->updatedAt = $result->updated_at;
        return $document;
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