<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/14/2016
 * Time: 12:27 PM
 */

namespace App\Libs\Helpers;


class AppHelper extends Helper
{
    public static function assetsPath($app, $version)
    {
        return url('/').'/ng-apps/'.$app.'/'.$version.'/assets';
    }

    public static function path($app, $version)
    {
        return url('/').'/ng-apps/'.$app.'/'.$version.'';
    }
}