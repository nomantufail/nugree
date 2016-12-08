<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:59 AM
 */

namespace App\Repositories\Interfaces\Transformers;


use App\Models\Models\Sql\Model;
use App\Models\Sql\UserDocument;

interface RepositoryTransformerInterface
{
    public function transform($object);
}