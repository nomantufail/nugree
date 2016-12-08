<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/4/2016
 * Time: 9:34 AM
 */

namespace App\DB\Providers\SQL\Factories\Factories\PropertyJson\Gateways\Helpers;


use App\Libs\Helpers\AuthHelper;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Traits\AppTrait;

trait UserPropertiesHelper
{
    use AppTrait;
    public function computeUserPropertiesParams($params)
    {
        $conditions =[];
        if(isset($params['purposeId']) && ($params['purposeId'] != null || $params['purposeId'] !=''))
            $conditions['properties.purpose_id'] = $params['purposeId'];
        if(isset($params['agencyId']) && ($params['agencyId'] != null || $params['agencyId'] !=''))
            $conditions['agencies.id'] = $params['agencyId'];
        if(isset($params['ownerId']) && ($params['ownerId'] != null || $params['ownerId'] !='')){
            $conditions['properties.owner_id'] = $params['ownerId'];
        }
        else{
            $user = (new AuthHelper())->user();
            $agencies = (new AgenciesRepoProvider())->repo()->getByUser($user->id);
            if(sizeof($agencies) > 0)
                $conditions['agencies.id'] = $agencies[0]->id;
            else
                $conditions['properties.owner_id'] = $user->id;
        }
        if(isset($params['statusId']) && ($params['statusId'] != null || $params['statusId'] !=''))
            $conditions['properties.property_status_id'] = $params['statusId'];
        if(isset($params['propertyId']) && ($params['propertyId'] != null || $params['propertyId'] !=''))
            $conditions['properties.id'] = $params['propertyId'];

        return $conditions;
    }
    public function getLimit($params)
    {
        $limit = [
            'limit' => config('constants.PROPERTIES_LIMIT'),
            'start' => 0
        ];
        if(isset($params['limit']) && ($params['limit'] !=null || $params['limit'] !=''))
            $limit['limit']  = $params['limit' ];
        if(isset($params['start']) && ($params['start'] != null || $params['start'] !=''))
            $limit['start']  = $params['start'];

        return $limit;
    }
    public function getFavouritePropertyLimit($params)
    {
        $limit = [
            'limit' => config('constants.PROPERTIES_LIMIT'),
            'start' => 0
        ];
        if(isset($params['limit']) && ($params['limit'] !=null || $params['limit'] !=''))
            $limit['limit']  = $params['limit' ];
        if(isset($params['start']) && ($params['start'] != null || $params['start'] !=''))
            $limit['start']  = $params['start'];

        return $limit;
    }
    public function getParamLimit($params)
    {
        $limit = [
            'limit' => 0,
            'start' => 0
        ];
        if(isset($params['limit']) && ($params['limit'] !=null || $params['limit'] !=''))
            $limit['limit']  = $params['limit' ];
        if(isset($params['start']) && ($params['start'] != null || $params['start'] !=''))
            $limit['start']  = $params['start'];

        return $limit;
    }
    public function sortBy($params)
    {
        $sort =
            [
            'sortOn'=>config('constants.PROPERTIES_SortOn'),
            'sortBy'=>config('constants.PROPERTIES_SortBy')
        ];

        if(isset($params['sortOn']) && ($params['sortOn'] !=null || $params['sortOn'] !=''))
            $sort['sortOn']  = $params['sortOn' ];
        if(isset($params['sortBy']) && ($params['sortBy'] != null || $params['sortBy'] !=''))
            $sort['sortBy']  = $params['sortBy'];
        return $sort;
    }

}