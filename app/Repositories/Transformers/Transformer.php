<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 11:07 AM
 */

namespace App\Repositories\Transformers;


use App\Transformers\Transformer as AppTransformer;
abstract class Transformer extends AppTransformer
{
    public function transformCollection(array $collection){
        return array_map([$this, 'transform'], $collection);
    }
    public abstract function transform($item);
}