<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:38 AM
 */

namespace App\Libs\Json\Creators\Creators;


use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;

abstract class JsonCreator
{
    protected $model = null;
    protected  $prototype = null;

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
    public function setPrototype(JsonPrototype $prototype)
    {
        $this->prototype = $prototype;
    }
}