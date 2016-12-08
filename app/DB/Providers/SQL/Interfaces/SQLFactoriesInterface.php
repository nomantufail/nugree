<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/1/2016
 * Time: 10:03 PM
 */

namespace App\DB\Providers\SQL\Interfaces;


interface SQLFactoriesInterface {
    function map($result);
    function find($id);
    function all();

}