<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 4/2/2016
 * Time: 8:53 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\Agency\Gateways;


use App\DB\Providers\SQL\Factories\Factories\AgencyStaff\AgencyStaffFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class AgencyQueryBuilder extends QueryBuilder{
    public function     __construct(){
        $this->table = "agencies";
    }

    public function addCities($agencyId, $cityIds)
    {
        $agencyCities = [];
        foreach($cityIds as $cityId)
            $agencyCities[] = ['agency_id' => $agencyId, 'city_id' => $cityId, 'created_at'=>date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')];
        return $this->insertMultiple($agencyCities, 'agency_cities');
    }
    public function getStaffAgency($staffId)
    {
       $agencyStaffTable =  (new AgencyStaffFactory())->getTable();
        return DB::table($agencyStaffTable)
            ->leftjoin($this->table,$agencyStaffTable.'.agency_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($agencyStaffTable.'.user_id','=',$staffId)
            ->first();

    }

}