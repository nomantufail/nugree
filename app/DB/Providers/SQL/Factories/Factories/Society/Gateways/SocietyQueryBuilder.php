<?php
namespace App\DB\Providers\SQL\Factories\Factories\Society\Gateways;
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory;
use App\DB\Providers\SQL\Factories\Factories\AgencySociety\AgencySocietyFactory;
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Factories\SocietyFiles\SocietyFilesFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class SocietyQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'societies';
    }

    public function getSocietiesByAgency($agencyId)
    {
       $agencySociety = (new AgencySocietyFactory())->getTable();

      return DB::table($agencySociety)
            ->leftjoin($this->table,$agencySociety.'.society_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($agencySociety.'.agency_id','=',$agencyId)
            ->get();
    }

    public function getSocietiesYouDealIn($agencyName)
    {
        $agencySociety = (new AgencySocietyFactory())->getTable();
        $agencyTable = (new AgencyFactory())->getTable();
        return  DB::table($agencySociety)
            ->leftjoin($this->table,$this->table.'.id','=',$agencySociety.'.society_id')
            ->leftjoin($agencyTable ,$agencySociety.'.agency_id','=',$agencyTable.'.id')
            ->select($this->table.'.*')
            ->where($agencyTable.'.agency','=',$agencyName)
            ->get();
    }
    public function getImportantSocieties()
    {
        return  DB::table($this->table)
            ->select($this->table.'.*')
            ->where($this->table.'.priority','>',0)
            ->orderBy($this->table.'.priority', 'asc')
            ->get();
    }
    public function getSocietiesForFile()
    {
        $societyFilesTable = (new SocietyFilesFactory())->getTable();
        return  DB::table($societyFilesTable)
            ->join($this->table,$societyFilesTable.'.society_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->get();
    }
    public function getByCity($cityId)
    {
         return DB::table($this->table)
            ->select($this->table.'.*')
            ->where($this->table.'.city_id','=',$cityId)
            ->get();
    }
}