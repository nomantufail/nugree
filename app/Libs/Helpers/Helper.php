<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/14/2016
 * Time: 12:27 PM
 */

namespace App\Libs\Helpers;


class Helper
{
    public static function propertyToArray(array $objects, $property)
    {
        $array = [];
        foreach($objects as $object)
        {
            $array[] = $object->$property;
        }
        return $array;
    }
    public static function rands($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



}