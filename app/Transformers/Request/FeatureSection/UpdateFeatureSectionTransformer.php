<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\FeatureSection;


use App\Transformers\Request\RequestTransformer;


class UpdateFeatureSectionTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id' =>$this->request->input('section_id'),
            'section'=>$this->request->input('section_name'),
            'priority'=>$this->request->input('priority'),
        ];
    }
}