<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models;

class Location {

    public $id = 0;
    public $cityId = "";
    public $location = 1;
    public $path="";
    public $lat ="";
    public $long ="";
    public $keyword="";
    public $description="";
    public $title="";
    public $index="";
    public $slug="";
    public $priority =0;
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct()
    {
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

} 

