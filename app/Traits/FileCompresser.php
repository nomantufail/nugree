<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits;

use App\Traits\AppTrait;

trait FileCompresser
{
    use AppTrait;

    public function compressImage($img)
    {
        $img = $img->heighten(env('PROPERTY_IMG_MAX_HEIGHT'), function ($constraint) {
            $constraint->upsize();
        });
        $img = $img->widen(env('PROPERTY_IMG_MAX_WIDTH'), function ($constraint) {
            $constraint->upsize();
        });
        return $img;
    }
}