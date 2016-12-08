<?php
namespace App\DB\Providers\SQL\Factories\Factories\SocietyFiles;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\SocietyFiles\Gateways\SocietyFilesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\SocietyFiles;

class SocietyFilesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new SocietyFiles();
        $this->tableGateway = new SocietyFilesQueryBuilder();
    }
    public function getSocietyFiles($societyId)
    {
        return $this->map($this->tableGateway->find($societyId));
    }
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function map($result)
    {
        $societyFiles = clone($this->model);
        $societyFiles->id = $result->id;
        $societyFiles->societyId = $result->society_id;
        $societyFiles->image = $result->image;
        $societyFiles->doc = $result->doc;
        $societyFiles->pdf = $result->pdf;
        $societyFiles->createdAt = $result->created_at;
        $societyFiles->updatedAt = $result->updated_at;
        return $societyFiles;
    }
    private function mapSocietyOnTable(SocietyFiles $society)
    {
        return [
            'society_id'    => $society->societyId,
            'image'    => $society->image,
            'doc'    => $society->doc,
            'pdf'    => $society->pdf,
            'updated_at' => $society->updatedAt,
        ];
    }
}