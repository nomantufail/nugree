<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Apps\GetAddPropertyWithAuthAppRequest;
use App\Http\Requests\Requests\Apps\GetDashboardAppRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Traits\AssignedFeaturesJsonDocumentsGenerator;
use App\Traits\User\UsersFilesReleaser;
use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\AssignedFeatureJsonRepoProvider;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\PropertyPurposesRepoProvider;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;


class AppsController extends Controller
{
    use AssignedFeaturesJsonDocumentsGenerator, UsersFilesReleaser;

    public $purposes  = "";
    public $statuses  = "";
    public $societies = "";
    public $locations = "";
    public $propertyTypes = "";
    public $propertySubTypes = "";
    public $landUnits   = "";
    public $agencyStaff = "";
    public $response = null;
    public $userAgency ="";
    public $properties ="";
    public $assignedFeaturesJson="";
    public $propertyStatuses = null;
    public $propertyJsonFactory = null;
    public $user = null;

    public function __construct(WebResponse $webResponse)
    {
        $this->purposes = (new PropertyPurposesRepoProvider())->repo();
        $this->statuses = (new PropertyStatusesRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->locations = (new LocationsRepoProvider())->repo();
        $this->cities = (new CitiesRepoProvider())->repo();
        $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
        $this->propertySubTypes = (new PropertySubTypesRepoProvider())->repo();
        $this->landUnits = (new LandUnitsRepoProvider())->repo();
        $this->userAgency = (new AgenciesRepoProvider())->repo();
        $this->agencyStaff = (new UsersJsonRepoProvider())->repo();
        $this->properties = (new PropertiesRepoProvider())->repo();
        $this->assignedFeaturesJson = (new AssignedFeatureJsonRepoProvider())->repo();
        $this->propertyStatuses = (new PropertyStatusesRepoProvider())->repo();
        $this->propertyJsonFactory = new PropertyJsonFactory();
        $this->response = $webResponse;
    }

    public function dashboard(GetDashboardAppRequest $appRequest)
    {
        $version = $appRequest->version();
        return $this->response->app('dashboard', $version);
    }
    public function addPropertyWithAuth(GetAddPropertyWithAuthAppRequest $appRequest)
    {

        if(!$appRequest->isNotAuthentic()){
            die(header('LocationValidators: '.url('/').'/dashboard#/home/properties/add'));
        }

        $version = $appRequest->version();
        return $this->response->app('AddPropertyWithAuth', $version, $this->addPropertyWithAuthResources());
    }

    public function addPropertyWithAuthResources()
    {
        $purposes  = $this->purposes->all();
        //$societies = $this->societies->all();
        $cities = $this->cities->all();
        $propertyTypes = $this->propertyTypes->all();
        $propertySubTypes = $this->propertySubTypes->all();
        $landUnits = $this->landUnits->all();
        $subTypeAssignedFeaturesJson = $this->assignedFeaturesJson->all();
        $userRoles = (new RolesRepoProvider())->repo()->all();
        return [
            'data'=>[
                'resources'=>[
                    'purposes'=>$purposes,
                    'propertyTypes'=>$propertyTypes,
                    'societies'=>[],
                    'propertySubTypes'=>$propertySubTypes,
                    'landUnits'=>$landUnits,
                    'subTypeAssignedFeatures'=>$subTypeAssignedFeaturesJson,
                    'userRoles' => $userRoles,
                    'cities' => $cities
                ]
            ]
        ];
    }
}
