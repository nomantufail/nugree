<?php
namespace App\DB\Providers\SQL\Factories\Factories\AssignedFeatures\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class AssignedFeaturesQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'assigned_features_documents';
    }
    public function getAllSubTypeAssignedFeatures()
    {
        return DB::table($this->table)
            ->select($this->table.'.json')
            ->get();
    }

}