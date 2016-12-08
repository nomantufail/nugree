<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Project;


use App\Transformers\Request\RequestTransformer;


class DeleteProjectTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'projectId' => $this->request->get('project_id'),
        ];
    }
}