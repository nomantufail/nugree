<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/6/2016
 * Time: 10:07 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\ReleasedFile\Gateways;

use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReleasedFileQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'released_files';
    }

    public function removeExpired()
    {
        $now = Carbon::createFromFormat('Y-m-d h:i:s',date('Y-m-d h:i:s'))->addHours(5)->toDateTimeString();
        return DB::table($this->table)->where('deadline','<',$now)->delete();
    }

    public function getExpiredFiles()
    {
        $now = Carbon::createFromFormat('Y-m-d h:i:s',date('Y-m-d h:i:s'))->addHours(5)->toDateTimeString();
        return DB::table($this->table)->where('deadline','<',$now)->get();
    }

    public function getByPaths(array $paths)
    {
        return $this->getWhereIn('file', $paths);
    }

}