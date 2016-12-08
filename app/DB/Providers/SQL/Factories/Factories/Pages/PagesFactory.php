<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Pages;

use App\DB\Providers\SQL\Factories\Factories\Block\Gateways\BlockQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\Pages\Gateways\PagesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Block;


class PagesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->tableGateway = new PagesQueryBuilder();
    }
    /**
     * @return array Country::class
     **/
    public function all()
    {
        return $this->tableGateway->all();
    }

    /**
     * @param string $id
     * @return Block::class
     **/
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
    public function store(Block $block)
    {
        $block->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapBlockOnTable($block));
    }

    public function map($result)
    {
        return true;
    }
    private function mapBlockOnTable(Block $block)
    {
        return [

        ];
    }
}