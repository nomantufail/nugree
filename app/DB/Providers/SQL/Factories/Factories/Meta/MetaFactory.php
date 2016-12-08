<?php

namespace App\DB\Providers\SQL\Factories\Factories\Meta;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Meta\Gateways\MetaQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Meta;

class MetaFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Meta();
        $this->tableGateway = new MetaQueryBuilder();
    }
    function store(Meta $meta)
    {
        return $this->tableGateway->insert($this->mapCityOnTable($meta));
    }
    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function getPageMeta($page)
    {
        try{
            return $this->map($this->tableGateway->first(['page'=>$page]));
        }
        catch(\Exception $e){
            return null;
        }
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }

    private function mapCityOnTable(Meta $meta)
    {
        return [
            'page' => $meta->page,
            'json'=>json_encode($meta),
            'created_at' => $meta->createdAt,
        ];
    }

    function map($result)
    {
        $record= json_decode($result->json);
        $meta= new Meta();
        $meta->id = $record->id;
        $meta->page = $record->page;
        $meta->keyword = $record->keyword;
        $meta->title = $record->title;
        $meta->description = $record->description;
        $meta->createdAt = $result->created_at;
        $meta->updatedAt = $result->updated_at;
        return $meta;
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