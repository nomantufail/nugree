<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\Http\Requests\Requests\AppsResources\GetDashboardResourcesRequest;

use App\Http\Responses\Responses\ApiResponse;
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
use App\Traits\AssignedFeaturesJsonDocumentsGenerator;
use App\Traits\User\UsersFilesReleaser;

class AppsResourceController extends ApiController
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

    public function __construct(ApiResponse $response)
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
        $this->response = $response;
    }
    public function dashboardResources(GetDashboardResourcesRequest $request)
    {
        $user = $request->getUserJsonModel();
        if($user == null)
            return $this->response->respondAuthenticationFailed();

        $user = $this->releaseAllUserFiles($user);
        $purposes  = $this->purposes->all();
        $statuses  = $this->statuses->all();
        $cities = $this->cities->all();
        $locations = $this->locations->all();
        $propertyStatusesIds = (object)$this->mapStatusesToArray($this->propertyStatuses->all());
        $propertyTypes = $this->propertyTypes->all();
        $propertySubTypes = $this->propertySubTypes->all();
        $landUnits = $this->landUnits->all();
        $subTypeAssignedFeaturesJson = $this->assignedFeaturesJson->all();
        $agencyStaff = $this->agencyStaff->getStaffByOwner($user->id);
        $agencyStaff = ((sizeof($agencyStaff) == 0)?[$user]:$agencyStaff);
        $favouriteProperties = $this->propertyJsonFactory->CountFavouriteProperties($user->id);
        $propertiesCounts  = $this->properties->countProperties($user->id);
        $userRoles = (new RolesRepoProvider())->repo()->all();
        return $this->response->respond([
            'data'=>[
                'resources'=>[
                    'purposes'=>$purposes,
                    'propertyStatuses'=>$statuses,
                    'propertyTypes'=>$propertyTypes,
                    'cities'=>$cities,
                    'locations'=>$locations,
                    'propertySubTypes'=>$propertySubTypes,
                    'landUnits'=>$landUnits,
                    'agencyStaff'=>$agencyStaff,
                    'propertiesCounts'=>$propertiesCounts,
                    'favouritesCount'=>$favouriteProperties,
                    'subTypeAssignedFeatures'=>$subTypeAssignedFeaturesJson,
                    'userRoles' => $userRoles,
                    'propertyStatusesIds'=>$propertyStatusesIds
                ],
                'authUser' => $user
            ],
            'access_token' => $_SESSION['authUser']->access_token
        ]);
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
        return $this->response->respond([
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
        ]);
    }

    private function mapStatusesToArray($propertyStatuses)
    {
        $final =[];
        foreach($propertyStatuses as $propertyStatus)
        {
            $final[$propertyStatus->name] = $propertyStatus->id;
        }
        return array_change_key_case($final,CASE_LOWER);
    }
}