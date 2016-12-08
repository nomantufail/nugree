<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 6/28/2016
 * Time: 12:02 PM
 */

namespace App\DB\Providers\SQL\Factories\Factories\UserJson;


trait TrustedAgentsSearchHelper
{
    public function computePagination(array $params)
    {
        $pagination = [
            'start' => 0,
            'limit' => config('constants.AGENTS_LIMIT')
        ];
        if(isset($params['start']) && $params['start'] != null)
            $pagination['start'] = $params['start'];
        if(isset($params['limit']) && $params['limit'] != null)
            $pagination['limit'] = $params['limit'];

        if(isset($params['page']) ){
            $page = intval($params['page']);
            $page = ($page < 1)?1: $page;
            $limit = intval($params['limit']);
            $limit = ($limit < 1)?config('constants.PROPERTIES_LIMIT'):$limit;
            $start = $limit*($page-1);

            $pagination['start'] = $start;
            $pagination['limit'] = $limit;
        }
        return $pagination;
    }
}