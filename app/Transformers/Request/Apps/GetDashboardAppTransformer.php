<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 10:55 AM
 */

namespace App\Transformers\Request\Apps;
use App\Transformers\Request\RequestTransformer;

class GetDashboardAppTransformer extends RequestTransformer
{
    public function transform()
    {
        return request()->all();
    }
}