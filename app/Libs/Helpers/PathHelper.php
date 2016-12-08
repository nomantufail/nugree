<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/14/2016
 * Time: 12:27 PM
 */

namespace App\Libs\Helpers;


class PathHelper extends Helper
{
    public static function ngApps()
    {
        return public_path('ng-apps');
    }

    public static function temp()
    {
        return public_path('temp');
    }
    public static function nugreeAdminPublicPath()
    {
         return 'http://admin.nugree.com';
        //return 'http://localhost/42admin/public';
    }
}