<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:40 AM
 */

namespace App\Libs\Json\Creators\Interfaces;


use App\Models\Models\Sql\Model;

interface JsonCreatorInterface
{
    public function create();
}