<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\DB\Providers\SQL\Models\UserSearches;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\AddUserSearchesValidator;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Transformers\Request\User\AddUserSearchesTransformer;


class AddUserSearchesRequest extends Request implements RequestInterface{

    public $validator;
    public $city ="";
    public function __construct(){
        parent::__construct(new AddUserSearchesTransformer($this->getOriginalRequest()));
        $this->validator = new AddUserSearchesValidator($this);
        $this->city = (new CitiesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getUserSearchesModel()
    {
        $userSearch = new UserSearches();
        $searchedParams = $this->explodeUrl();

        $userSearch->purposeId = (isset($searchedParams['nugree']['purpose_id']))?$searchedParams['nugree']['purpose_id']:0;
        $userSearch->typeId = (isset($searchedParams['nugree']['property_type_id']))?$searchedParams['nugree']['property_type_id']:0;
        $userSearch->subTypeId = (isset($searchedParams['nugree']['sub_type_id']))?$searchedParams['nugree']['sub_type_id']:0;
        $userSearch->countryId = (isset($searchedParams['nugree']['city_id']))?$this->getCity($searchedParams['nugree']['city_id']):0;
        $userSearch->cityId = (isset($searchedParams['nugree']['city_id']))?$searchedParams['nugree']['city_id']:0;
        $userSearch->locationId = (isset($searchedParams['nugree']['location_id']))?$searchedParams['nugree']['location_id']:0;
        $userSearch->landAreaFrom = (isset($searchedParams['nugree']['land_area_from']))?$searchedParams['nugree']['land_area_from']:0;
        $userSearch->landAreaTo = (isset($searchedParams['nugree']['land_area_to']))?$searchedParams['nugree']['land_area_to']:0;
        $userSearch->landUnitId = (isset($searchedParams['nugree']['land_unit_id']))?$searchedParams['nugree']['land_unit_id']:0;
        $userSearch->priceFrom = (isset($searchedParams['nugree']['price_from']))?$searchedParams['nugree']['price_from']:0;
        $userSearch->priceTo = (isset($searchedParams['nugree']['price_to']))?$searchedParams['nugree']['price_to']:0;
        $userSearch->email = $this->get('email');
        $userSearch->mobile = $this->get('mobile');

        return $userSearch;
    }
    public function explodeUrl()
    {
        $url = $this->get('searchedParams');
        $remove_http = str_replace('http://', '', $url);
        $split_url = explode('?', $remove_http);
        $get_page_name = explode('/', $split_url[0]);
        $page_name = $get_page_name[1];
        $split_parameters = explode('&', $split_url[1]);

        for($i = 0; $i < count($split_parameters); $i++) {
            $final_split = explode('=', $split_parameters[$i]);
            $split_complete[$page_name][$final_split[0]] = $final_split[1];
        }

        return $split_complete;
    }
    public function getCity($cityId)
    {
        $city = $this->city->getById($cityId);
        return $city->countryId;
    }
}