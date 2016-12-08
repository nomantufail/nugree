<?php
namespace App\DB\Providers\SQL\Factories\Factories\SocietyMaps\Gateways;
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class SocietyMapsQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'societies_maps';
    }

    public function getSocietyMaps($societyId)
    {
        $societyTable = (new SocietyFactory())->getTable();

        return DB::table($this->table)
            ->leftjoin($societyTable,$this->table.'.society_id','=',$societyTable.'.id')
            ->select($this->table.'.*',$societyTable.'.society')
            ->where($this->table.'.society_id','=',$societyId)
            ->get();
    }
}