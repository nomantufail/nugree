<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits;

use App\DB\Providers\SQL\Models\Property;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Repositories\Providers\Providers\BlocksRepoProvider;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\PropertyPurposesRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Traits\AppTrait;

trait Breadcrumbs
{
    use AppTrait;

    public function propertyBreadcrumbs(PropertyJsonPrototype $property)
    {
        $breadCrumbs = [];
        $destination = url('/search?');
        $destination.="purpose_id=".$property->purpose->id;
        $breadCrumbs['purpose'] = ['title'=>$property->purpose->name,'destination'=>$destination,'original'=>$property->purpose];
        $destination.="&property_type_id=".$property->type->parentType->id;
        $breadCrumbs['type'] = ['title'=>$property->type->parentType->name,'destination'=>$destination,'original'=>$property->type->parentType];
        $destination.="&sub_type_id=".$property->type->subType->id;
        $breadCrumbs['subType'] = ['title'=>$property->type->subType->name,'destination'=>$destination,'original'=>$property->type->subType];
        $destination=url('properties')."/".$property->location->city->slug;
        $breadCrumbs['city'] = ['title'=>$property->location->city->name,'destination'=>$destination,'original'=>$property->location->city];
        $destination=url('properties')."/".$property->location->city->slug."/".$property->location->location->slug;
        $breadCrumbs['location'] = ['title'=>$property->location->location->location,'destination'=>$destination,'original'=>$property->location->location];

        return $breadCrumbs;
    }

    public function listingBreadCrumbs($params)
    {
        $paramObjects = [];
        $purposes = (new PropertyPurposesRepoProvider())->repo();
        $types = (new PropertyTypesRepoProvider())->repo();
        $subTypes = (new PropertySubTypesRepoProvider())->repo();
        $cities = (new CitiesRepoProvider())->repo();
        $locations = (new LocationsRepoProvider())->repo();
        $blocks = (new BlocksRepoProvider())->repo();

        $paramObjects['type'] = ($params['propertyTypeId'] != null)?$types->getById($params['propertyTypeId']):null;
        $paramObjects['subType'] = ($params['subTypeId'] != null)?$subTypes->getById($params['subTypeId']):null;
        $paramObjects['purpose'] = ($params['purposeId'] != null)?$purposes->getById($params['purposeId']):null;
        $paramObjects['city'] = ($params['cityId'] != null)?$cities->getById($params['cityId']):null;
        $paramObjects['location'] = ($params['locationId'] != null)?$locations->getById($params['locationId'][0]):null;
        //$paramObjects['block'] = ($params['blockId'] != null)?$blocks->getById($params['blockId']):null;

        $breadCrumbs = [];
        $objs = $paramObjects;
        $destination = url('/search?');
        if($objs['type'] != null){
            $destination.="property_type_id=".$objs['type']->id;
            $breadCrumbs['type'] = ['title'=>$objs['type']->name,'destination'=>$destination,'original'=>$objs['type']];
        }
        if($objs['subType'] != null){
            $destination.="&sub_type_id=".$objs['subType']->id;
            $breadCrumbs['subType'] = ['title'=>$objs['subType']->name,'destination'=>$destination,'original'=>$objs['subType']];
        }
        if($objs['purpose'] != null){
            $destination.="&purpose_id=".$objs['purpose']->id;
            $breadCrumbs['purpose'] = ['title'=>$objs['purpose']->name,'destination'=>$destination,'original'=>$objs['purpose']];
        }
        if($objs['city'] != null){
            $destination.="&city_id=".$objs['city']->id;
            $breadCrumbs['city'] = ['title'=>$objs['city']->name,'destination'=>$destination,'original'=>$objs['city']];
        }
        if($objs['location'] != null){
            $destination.="&location_id=".$objs['location']->id;
            $breadCrumbs['location'] = ['title'=>$objs['location']->location,'destination'=>$destination,'original'=>$objs['location']];
        }
//        if($objs['block'] != null){
//            $destination.="&block_id=".$objs['block']->id;
//            $breadCrumbs['block'] = ['title'=>$objs['block']->name,'destination'=>$destination,'original'=>$objs['block']];
//        }

        return $breadCrumbs;
    }
}