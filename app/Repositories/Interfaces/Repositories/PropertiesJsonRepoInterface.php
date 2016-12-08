<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:59 AM
 */

namespace App\Repositories\Interfaces\Repositories;


use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;

interface PropertiesJsonRepoInterface
{
    function find($id);
    function all();
    function search(array $params);

    function update($user);
    function delete($id);
    function store(PropertyJsonPrototype $user);
}