<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 6/9/2016
 * Time: 5:57 AM
 */

namespace App\Libs\SearchEngines\Properties;


use App\Libs\SearchEngines\Properties\Engines\Cheetah;
use App\Libs\SearchEngines\Properties\Engines\Falcon;

class SearchEngineProvider
{
    public function cheetah()
    {
        return new Cheetah();
    }

    public function falcon()
    {
        return new Falcon();
    }
}