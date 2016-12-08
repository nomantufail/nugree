<?php



/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\FeatureSection;
use App\DB\Providers\SQL\Factories\Factories\FeatureSection\Gateways\FeatureSectionQueryBuilder;

use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\FeatureSection;

class FeatureSectionFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new FeatureSection();
        $this->tableGateway = new FeatureSectionQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function update(FeatureSection $featureSection)
    {
        $featureSection->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($featureSection->id ,$this->mapSectionOnTable($featureSection));
    }
    public function store(FeatureSection $featureSection)
    {
        $featureSection->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapSectionOnTable($featureSection));
    }
    public function delete(FeatureSection $featureSection)
    {
        return $this->tableGateway->delete($featureSection->id);
    }
    private function mapSectionOnTable(FeatureSection $featureSection)
    {
        return [
            'section'=>$featureSection->name,
            'priority'=>$featureSection->priority,
            'updated_at' => $featureSection->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $featureSection = new FeatureSection();
        $featureSection->id = $result->id;
        $featureSection->name = $result->section;
        $featureSection->priority = $result->priority;
        $featureSection->createdAt = $result->created_at;
        $featureSection->updatedAt = $result->updated_at;
        return $featureSection;
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