<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class PropertyStatusTableSeeder extends Seeder
{
    public $activeStatusId =5;
    public $pendingStatusId =10;
    public $rejectedStatusId =15;
    public $expiredStatusId =20;
    public $deletedStatusId =25;

 public function run()
 {
     /**
      * Please Never Ever change the Status Position
      */
     DB::table('property_statuses')->insert([
         ['id' => $this->getActiveStatusId(), 'status'=>'Active'],
         ['id' => $this->getPendingStatusId(), 'status'=>'Pending'],
         ['id' =>$this->getRejectedStatusId(), 'status'=>'Rejected'],
         ['id' => $this->getExpiredStatusId(), 'status'=>'Expired'],
         ['id' => $this->getDeletedStatusId(), 'status'=>'Deleted'],
     ]);
 }

    /**
     * @return int
     */
    public function getActiveStatusId()
    {
        return $this->activeStatusId;
    }

    /**
     * @return int
     */
    public function getPendingStatusId()
    {
        return $this->pendingStatusId;
    }

    /**
     * @return int
     */
    public function getRejectedStatusId()
    {
        return $this->rejectedStatusId;
    }

    /**
     * @return int
     */
    public function getExpiredStatusId()
    {
        return $this->expiredStatusId;
    }

    /**
     * @return int
     */
    public function getDeletedStatusId()
    {
        return $this->deletedStatusId;
    }
    public function getAllStatusIds()
    {
        return [
            $this->getDeletedStatusId(),
            $this->getActiveStatusId(),
            $this->getPendingStatusId(),
            $this->getRejectedStatusId(),
            $this->getExpiredStatusId(),
        ];
    }

}