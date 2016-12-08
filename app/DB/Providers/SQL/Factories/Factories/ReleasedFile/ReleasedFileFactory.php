<?php

/**
 * Created by Noman Tufail.
 * User: JR Tech
 * Date: 4/14/2016
 * Time: 10:36 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\ReleasedFile;

use App\DB\Providers\SQL\Factories\Factories\ReleasedFile\Gateways\ReleasedFileQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\ReleasedFile;

class ReleasedFileFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new ReleasedFile();
        $this->tableGateway = new ReleasedFileQueryBuilder();
    }

    public function removeExpiredFiles()
    {
        return $this->tableGateway->removeExpired();
    }

    public function getExpiredFiles()
    {
        return $this->mapCollection($this->tableGateway->getExpiredFiles());
    }

    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function all()
    {
        return $this->mapCollection($this->tableGateway->all());
    }

    public function getByPaths(array $paths)
    {
        return $this->mapCollection($this->tableGateway->getByPaths($paths));
    }

    public function update(ReleasedFile $file)
    {
        $file->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($file->id ,$this->mapReleasedFileOnTable($file));
    }
    public function store(ReleasedFile $file)
    {
        $file->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapReleasedFileOnTable($file));
    }
    public function storeMultiple(array $files)
    {
        $records = [];
        foreach($files as $file) {
            $file->created_at = date('Y-m-d h:i:s');
            $records[] = $this->mapReleasedFileOnTable($file);
        }
        return $this->tableGateway->insertMultiple($records);
    }
    public function delete(ReleasedFile $file)
    {
        return $this->tableGateway->delete($file->id);
    }
    public function deleteByIds(array $ids)
    {
        return $this->tableGateway->deleteByIds($ids);
    }
    private function mapReleasedFileOnTable(ReleasedFile $file)
    {
        return [
            'file' => $file->path,
            'deadline'=>$file->deadline,
            'updated_at' => $file->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    function map($result)
    {
        $file            = clone($this->model);
        $file->id = $result->id;
        $file->path = $result->file;
        $file->deadline = $result->deadline;
        $file->createdAt = $result->created_at;
        $file->updatedAt = $result->updated_at;
        return $file;
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