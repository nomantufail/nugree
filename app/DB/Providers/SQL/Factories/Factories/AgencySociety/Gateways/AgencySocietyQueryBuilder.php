<?php
namespace App\DB\Providers\SQL\Factories\Factories\AgencySociety\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class AgencySocietyQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'agency_societies';
    }

    public function deleteAgencySocieties($agencyId, $societyIds)
    {
        return DB::table($this->table)
            ->where('agency_id',$agencyId)
            ->whereIn('society_id', $societyIds)
            ->delete();
    }

}