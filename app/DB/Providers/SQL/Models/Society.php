<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:37 AM
 */

namespace App\DB\Providers\SQL\Models;


class Society
{
    public $id = 0;
    public $name = "";
    public $cityId = 0;
    public $important = 0;
    public $priority = 0;
    public $path ="";
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

}