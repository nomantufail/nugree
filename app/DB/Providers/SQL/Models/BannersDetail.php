<?php
namespace App\DB\Providers\SQL\Models;
/**
 * Created by PhpStorm.
 * User: jrpro_000
 * Date: 8/30/2016
 * Time: 12:09 AM
 */
class BannersDetail
{
    public $id = 0;
    public $image ="";
    public $position ="";
    public $bannerType ="";
    public $bannerPriority ="";
    public $bannerLink ="";
    public $page ="";

    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct(){
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }
}