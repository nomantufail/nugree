<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 3/3/2016
 * Time: 5:02 PM
 */

namespace App\Libs\Helpers;

class LandArea extends Helper
{
    public static function convert($from, $to, $area){
        $to = strtolower($to);
        if($from == $to)
            return $area;

        $computedArea = $area;
        switch(strtolower($from))
        {
            case 'square feet':
                switch($to)
                {
                    case 'square yards':
                        $computedArea = self::squareFeetsToSquareYards($area);
                        break;
                    case 'square meters':
                        $computedArea = self::squareFeetsToSquareMeters($area);
                        break;
                    case 'marla':
                        $computedArea = self::squareFeetsToMarla($area);
                        break;
                    case 'kanal':
                        $computedArea = self::squareFeetsToKanal($area);
                        break;
                    case 'acre':
                        $computedArea = self::squareFeetsToAcre($area);
                        break;
                }
                break;
            case 'square yards':
                switch($to)
                {
                    case 'square feet':
                        $computedArea = self::squareYardsToSquareFeets($area);
                        break;
                    case 'square meters':
                        $computedArea = self::squareYardsToSquareMeters($area);
                        break;
                    case 'marla':
                        $computedArea = self::squareYardsToMarla($area);
                        break;
                    case 'kanal':
                        $computedArea = self::squareYardsToKanal($area);
                        break;
                    case 'acre':
                        $computedArea = self::squareYardsToAcre($area);
                        break;
                }
                break;
            case 'square meters':
                switch($to)
                {
                    case 'square yards':
                        $computedArea = self::squareMetersToSquareYards($area);
                        break;
                    case 'square feet':
                        $computedArea = self::squareMetersToSquareFeets($area);
                        break;
                    case 'marla':
                        $computedArea = self::squareMetersToMarla($area);
                        break;
                    case 'kanal':
                        $computedArea = self::squareMetersToKanal($area);
                        break;
                    case 'acre':
                        $computedArea = self::squareMetersToAcre($area);
                        break;
                }
                break;
            case 'marla':
                switch($to)
                {
                    case 'square yards':
                        $computedArea = self::marlaToSquareYards($area);
                        break;
                    case 'square feet':
                        $computedArea = self::marlaToSquareFeets($area);
                        break;
                    case 'square meters':
                        $computedArea = self::marlaToSquareMeters($area);
                        break;
                    case 'kanal':
                        $computedArea = self::marlaToKanal($area);
                        break;
                    case 'acre':
                        $computedArea = self::marlaToAcre($area);
                        break;
                }
                break;
            case 'kanal':
                switch($to)
                {
                    case 'square yards':
                        $computedArea = self::kanalToSquareYards($area);
                        break;
                    case 'square feet':
                        $computedArea = self::kanalToSquareFeets($area);
                        break;
                    case 'square meters':
                        $computedArea = self::kanalToSquareMeters($area);
                        break;
                    case 'marla':
                        $computedArea = self::kanalToMarla($area);
                        break;
                    case 'acre':
                        $computedArea = self::kanalToAcre($area);
                        break;
                }
                break;
            case 'acre':
                switch($to)
                {
                    case 'square yards':
                        $computedArea = self::acreToSquareYards($area);
                        break;
                    case 'square feet':
                        $computedArea = self::acreToSquareFeets($area);
                        break;
                    case 'square meters':
                        $computedArea = self::acreToSquareMeters($area);
                        break;
                    case 'marla':
                        $computedArea = self::acreToMarla($area);
                        break;
                    case 'kanal':
                        $computedArea = self::acreToKanal($area);
                        break;
                }
                break;

        }
        return $computedArea;
    }

    public static function marlaToSquareYards($area)
    {
        return round(($area * 25), 3);
    }
    public static function marlaToSquareFeets($area)
    {
        return round(($area * 225), 3);
    }
    public static function marlaToSquareMeters($area)
    {
        return round(($area * 20.9), 3);
    }
    public static function marlaToKanal($area)
    {
        return round(($area / 20), 3);
    }
    public static function marlaToAcre($area)
    {
        return round(($area / 160), 3);
    }

    public static function squareFeetsToSquareYards($area)
    {
        $marlas = self::squareFeetsToMarla($area);
        return self::marlaToSquareYards($marlas);
    }
    public static function squareFeetsToMarla($area)
    {
        return round(($area / 225), 3);
    }
    public static function squareFeetsToSquareMeters($area)
    {
        $marlas = self::squareFeetsToMarla($area);
        return self::marlaToSquareMeters($marlas);
    }
    public static function squareFeetsToKanal($area)
    {
        $marlas = self::squareFeetsToMarla($area);
        return self::marlaToKanal($marlas);
    }
    public static function squareFeetsToAcre($area)
    {
        $marlas = self::squareFeetsToMarla($area);
        return self::marlaToAcre($marlas);
    }


    public static function squareYardsToMarla($area)
    {
        return round(($area / 25), 3);
    }
    public static function squareYardsToSquareFeets($area)
    {
        $marlas = self::squareYardsToMarla($area);
        return self::marlaToSquareFeets($marlas);
    }
    public static function squareYardsToSquareMeters($area)
    {
        $marlas = self::squareYardsToMarla($area);
        return self::marlaToSquareMeters($marlas);
    }
    public static function squareYardsToKanal($area)
    {
        $marlas = self::squareYardsToMarla($area);
        return self::marlaToKanal($marlas);
    }
    public static function squareYardsToAcre($area)
    {
        $marlas = self::squareYardsToMarla($area);
        return self::marlaToAcre($marlas);
    }


    public static function squareMetersToSquareYards($area)
    {
        $marlas = self::squareMetersToMarla($area);
        return self::marlaToSquareYards($marlas);
    }
    public static function squareMetersToSquareFeets($area)
    {
        $marlas = self::squareMetersToMarla($area);
        return self::marlaToSquareFeets($marlas);
    }
    public static function squareMetersToMarla($area)
    {
        return round(($area / 20.9), 3);
    }
    public static function squareMetersToKanal($area)
    {
        $marlas = self::squareMetersToMarla($area);
        return self::marlaToKanal($marlas);
    }
    public static function squareMetersToAcre($area)
    {
        $marlas = self::squareMetersToMarla($area);
        return self::marlaToAcre($marlas);
    }


    public static function kanalToSquareYards($area)
    {
        $marlas = self::kanalToMarla($area);
        return self::marlaToSquareYards($marlas);
    }
    public static function kanalToSquareFeets($area)
    {
        $marlas = self::kanalToMarla($area);
        return self::marlaToSquareFeets($marlas);
    }
    public static function kanalToMarla($area)
    {
        return round(($area * 20), 3);
    }
    public static function kanalToSquareMeters($area)
    {
        $marlas = self::kanalToMarla($area);
        return self::marlaToSquareMeters($marlas);
    }
    public static function kanalToAcre($area)
    {
        $marlas = self::kanalToMarla($area);
        return self::marlaToAcre($marlas);
    }


    public static function AcreToSquareYards($area)
    {
        $marlas = self::AcreToMarla($area);
        return self::marlaToSquareYards($marlas);
    }
    public static function AcreToSquareFeets($area)
    {
        $marlas = self::AcreToMarla($area);
        return self::marlaToSquareFeets($marlas);
    }
    public static function AcreToMarla($area)
    {
        return round(($area * 160), 3);
    }
    public static function AcreToSquareMeters($area)
    {
        $marlas = self::AcreToMarla($area);
        return self::marlaToSquareMeters($marlas);
    }
    public static function AcreToKanal($area)
    {
        $marlas = self::AcreToMarla($area);
        return self::marlaToKanal($marlas);
    }
}