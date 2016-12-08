<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 5:54 PM
 */

namespace App\DB\Providers\SQL\Factories;


use App\DB\Providers\Factory;

abstract class SQLFactory extends Factory {
    public $model = null;

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