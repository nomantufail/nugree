<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:37 AM
 */

namespace App\DB\Providers\SQL\Models;


class News
{
    public $id = 0;
    public $title ="";
    public $description ="";


    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct(){
        $this->createdAt = date('Y-m-d');
        $this->updatedAt = $this->createdAt;
    }

}