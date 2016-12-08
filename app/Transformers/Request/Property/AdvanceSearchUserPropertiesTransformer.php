<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;


use App\Transformers\Request\RequestTransformer;


class AdvanceSearchUserPropertiesTransformer extends RequestTransformer
{
    public function transform()
    {
        $searchPropertiesTransformer = new SearchPropertiesTransformer($this->request);
        return array_merge($searchPropertiesTransformer->transform(), [
            'userId' => $this->request->get('userId')
        ]);
    }
}