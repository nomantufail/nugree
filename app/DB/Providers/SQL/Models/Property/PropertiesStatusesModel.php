<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/23/2016
 * Time: 12:47 PM
 */

namespace App\DB\Providers\SQL\Models\Property;


class PropertiesStatusesModel
{
    public $active   = 0;
    public $pending  = 0;
    public $expired  = 0;
    public $deleted  = 0;
    public $rejected = 0;
    public $approved = 0;
}