<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:28 PM
 */
namespace App\DB\Providers\SQL\Factories\Helpers;

use Illuminate\Support\Facades\DB;

abstract class QueryBuilder {
    protected $table = "";
    public function __construct(){}

    public function first(array $where = [])
    {
        $result = DB::table($this->table)->where($where)->first();
        return $result;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function findBy($column, $value)
    {
        return $this->first([$column => $value]);
    }

    /*
     * function returns multiple records based on conditions..
     */
    public function getWhere(array $where)
    {
        $result = DB::table($this->table)->where($where)->get();
        return $result;
    }

    /*
     * function returns multiple records based on conditions..
     */
    public function getBy($column, $value)
    {
        return $this->getWhere([$column => $value]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->first(['id'=>$id]);
    }

    public function insert(array $record)
    {
        return DB::table($this->table)->insertGetId($record);
    }
    public function count($condition)
    {
        return DB::table($this->table)->where($condition)->count();
    }
    public function insertMultiple(array $records, $table = null)
    {
        $table = ($table != null)?$table:$this->table;
        return DB::table($table)->insert($records);
    }
    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        return $this->updateWhere(['id' => $id], $data);
    }

    /**
     * @param array $conditions
     * @param array $data
     * @return mixed
     */
    public function updateWhere(array $conditions, array $data)
    {
        $query = DB::table($this->table);
        foreach($conditions as $column => $value)
        {
            $query = $query->where($column,$value);
        }
         return $query->update($data);
    }
    public function incrementValuesWhereIn($whereColumn, $in , $incrementColumn)
    {
        return DB::table($this->table)->whereIn($whereColumn, $in)->increment($incrementColumn);
    }
    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return DB::table($this->table)->where('id','=',$id)->delete();
    }

    /**
     * @param array $ids
     * @return bool
     */
    public function deleteByIds(array $ids)
    {
        return (sizeof($ids)> 0)?DB::table($this->table)->whereIn('id', $ids)->delete():true;
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function deleteWhere(array $conditions)
    {
        return DB::table($this->table)->where($conditions)->delete();
    }
    /**
     * @return mixed
     */
    public function all()
    {
        return DB::table($this->table)->get();
    }

    /**
     * @param $column
     * @param array $conditions
     * @return mixed
     */
    public function getWhereIn($column, array $conditions)
    {
        return DB::table($this->table)->whereIn($column, $conditions)->get();
    }

    /**
     * @param $column
     * @param array $conditions
     * @return mixed
     */
    public function deleteWhereIn($column, array $conditions)
    {
        return DB::table($this->table)->whereIn($column, $conditions)->delete();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->all();
    }
}