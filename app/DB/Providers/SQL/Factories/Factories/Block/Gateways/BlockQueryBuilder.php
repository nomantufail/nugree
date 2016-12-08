<?php
namespace App\DB\Providers\SQL\Factories\Factories\Block\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class BlockQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'blocks';
    }

    public function getBySociety($blockId)
    {
        $societyFactory = new SocietyFactory();
        $societyTable = $societyFactory->getTable();
        return  DB::table($this->table)
            ->leftjoin($societyTable,$this->table.'.society_id','=',$societyTable.'.id')
            ->select($societyTable.'.*')
            ->where($this->table.'.id','=',$blockId)
            ->orderBy($this->table.'.id','=','DESC')
            ->first();
    }

    public function getBlocksBySociety($societyId)
    {
        return DB::table($this->table)
            ->select($this->table.'.*')
            ->where($this->table.'.society_id' ,'=',$societyId)
            ->orderBy($this->table.'.id','=','DESC')
            ->get();
    }
    public function getBlocksWithSociety()
    {
        $societyTable = (new SocietyFactory())->getTable();
        return  DB::table($this->table)
            ->leftjoin($societyTable,$this->table.'.society_id','=',$societyTable.'.id')
            ->select($societyTable.'.id as societyId',$societyTable.'.society')
            ->orderBy($this->table.'.id','DESC')
            ->get();
    }
}