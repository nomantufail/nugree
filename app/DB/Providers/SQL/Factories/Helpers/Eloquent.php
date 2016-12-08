<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 9:28 PM
 */
namespace App\DB\Providers\SQL\Factories\Helpers;

use App\DB\Providers\SQL\Models\User;
use Illuminate\Database\Eloquent\Model as EloquentModel;
abstract class Eloquent extends EloquentModel{
    protected $table = "";
    protected $fillable = [];
    protected $model = null;

    public function find($id)
    {
        return $this->map(parent::find($id));
    }

    public function insert(array $record)
    {
        return $this->map(parent::create($record));
    }

    public function get()
    {

    }

    public function map($result)
    {
        $vars = get_object_vars($this->model);
        foreach($vars as $var => $defaultValue)
        {
            $this->model->$var = $result->$var;
        }
        return $this->model;
    }

    public function mapCollection(array $results)
    {
        return array_map([$this, 'map'], $results);
    }
} 