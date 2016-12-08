<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models;

class ReleasedFile {

    public $id = 0;
    public $path = "";
    public $deadline = '0000-00-00 00:00:00';
    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct()
    {
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

} 

