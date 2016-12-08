<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Location;


use App\Transformers\Request\RequestTransformer;


class GetLocationTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'locationSlug' =>$this->request->location_slug,
            'page' => $this->request->get('page'),
            'limit' => $this->request->get('limit'),
            'sortBy' => $this->request->get('sort_by'),
            'order' => $this->request->get('order')
        ];
    }
}