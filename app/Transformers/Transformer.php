<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:18 PM
 */

namespace App\Transformers;


abstract class Transformer {

    public function transformCollection(array $records){
        return array_map([$this, 'transform'], $records);
    }
} 