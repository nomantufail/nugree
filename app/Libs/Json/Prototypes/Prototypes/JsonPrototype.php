<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:44 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes;


abstract class JsonPrototype
{
    public function encode()
    {
        return json_encode($this);
    }

    public function map($object)
    {
        $vars = get_object_vars($object);
        foreach($vars as $name => $value) {
            $this->$name = $value;
        }

        return $this;
    }
}