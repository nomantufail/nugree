<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Block;

use App\DB\Providers\SQL\Factories\Factories\Block\Gateways\BlockQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Block;


class BlockFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new Block();
        $this->tableGateway = new BlockQueryBuilder();
    }
    /**
     * @return array Country::class
     **/
    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    /**
     * @param string $id
     * @return Block::class
     **/
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function getBlocksWithSociety()
    {
        return $this->tableGateway->getBlocksWithSociety();
    }
    /**
     * @param Block $block
     * @return bool
     **/
    public function update(Block $block)
    {
        $block->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($block->id, $this->mapBlockOnTable($block));
    }

    /**
     * @param array $where
     * @param array $data
     * @return bool
     **/
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function store(Block $block)
    {
        $block->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBlockOnTable($block));
    }
    public function getBlocksBySociety($societyId)
    {
        return $this->mapCollection($this->tableGateway->getBlocksBySociety($societyId));
    }
    /**
     * @param Block $block
     * @return int
     **/
    public function delete(Block $block)
    {
        return $this->tableGateway->delete($block->id);
    }
    public function getBySociety($id)
    {
        return $this->tableGateway->getBySociety($id);
    }
    public function map($result)
    {
        $society = clone($this->model);
        $society->id = $result->id;
        $society->name = $result->block;
        $society->societyId = $result->society_id;
        $society->createdAt = $result->created_at;
        $society->updatedAt = $result->updated_at;
        return $society;
    }
    private function mapBlockOnTable(Block $block)
    {
        return [
            'block'     => $block->name,
            'society_id'=> $block->societyId,
            'updated_at'=> $block->updatedAt,
        ];
    }
}