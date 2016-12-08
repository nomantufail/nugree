<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\IndexRequest;
use App\Http\Requests\Requests\Location\GetLocationRequest;
use App\Http\Requests\Requests\Property\GetPropertyRequest;
use App\Http\Requests\Requests\Property\RouteToAddPropertyRequest;
use App\Http\Requests\Requests\Property\SearchPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Requests\Requests\Property\WantedPropertyRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Auth\Web;
use App\Libs\SearchEngines\Properties\Engines\Cheetah;
use App\Repositories\Providers\Providers\AssignedFeatureJsonRepoProvider;
use App\Repositories\Providers\Providers\BannersRepoProvider;
use App\Repositories\Providers\Providers\BlocksRepoProvider;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\NewsRepoProvider;
use App\Repositories\Providers\Providers\ProjectsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\FavouritePropertyRepository;
use App\Traits\Breadcrumbs;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;
use App\Traits\Property\ShowAddPropertyFormHelper;
use App\Transformers\Response\PropertyTransformer;
use Illuminate\Support\Facades\Redirect;

class PropertiesController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper, ShowAddPropertyFormHelper, Breadcrumbs;
    public $PropertyTransformer = null;
    public $properties = "";
    public $societies = null;
    public $blocks = null;
    public $propertyTypes = null;
    public $propertySubtypes = null;
    public $landUnits = null;
    public $propertyStatuses = null;
    public $favouriteFactory = null;
    public $users = null;
    public $assignedFeaturesJson = null;
    public $propertiesRepo = null;
    public $userRepo = null;
    public $status = null;
    public $banners = null;
    public $locations = null;
    public $news =null;
    public $projectRepo;
    public $cities;
    public $auth = null;

    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {
        $this->response = $webResponse;
        $this->PropertyTransformer = $propertyTransformer;
        $this->propertiesRepo = (new PropertiesRepoProvider())->repo();
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
        $this->societies = (new SocietiesRepoProvider())->repo();
        $this->blocks = (new BlocksRepoProvider())->repo();
        $this->propertyTypes = (new PropertyTypesRepoProvider())->repo();
        $this->propertySubtypes = (new PropertySubTypesRepoProvider())->repo();
        $this->landUnits = (new LandUnitsRepoProvider())->repo();
        $this->favouriteFactory = new FavouritePropertyRepository();
        $this->users = (new UsersJsonRepoProvider())->repo();
        $this->userRepo = (new UsersRepoProvider())->repo();
        $this->assignedFeaturesJson = (new AssignedFeatureJsonRepoProvider())->repo();
        $this->status = new \PropertyStatusTableSeeder();
        $this->banners = (new BannersRepoProvider())->repo();
        $this->projectRepo = (new ProjectsRepoProvider())->repo();
        $this->cities = (new CitiesRepoProvider())->repo();
        $this->news = (new NewsRepoProvider())->repo();
        $this->locations = (new LocationsRepoProvider())->repo();
        $this->auth = new Web();

    }
    public function wantedProperties(WantedPropertyRequest $request)
    {
        $params = $request->getParams();
        $params['sortBy'] = 'updated_at';
        $loggedInUser = $request->user();
        $properties = $this->properties->search($request->getParams());
        $propertiesCount = count($properties);
        $totalPropertiesFound = (new Cheetah())->count();
        $banners = $this->getPropertyListingPageBanners($params);
        return $this->response->setView('frontend.v1.wanted_property_listing')->respond(['data' => [
            'properties' => $this->releaseAllPropertiesFiles($properties),
            'totalProperties'=> $totalPropertiesFound[0]->total_records,
            'isFavourite' => $this->getFavourite($loggedInUser,$properties),
            'societies'=>$this->societies->all(),
            'blocks'=>$this->blocks->getBlocksBySociety($request->get('societyId')),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes(),
            'landUnits'=>$this->landUnits->all(),
            'propertiesCount'=>$propertiesCount,
            'cities'=>$this->cities->all(),
            'oldValues'=>$request->all(),
            'banners'=>$banners
        ]]);

    }
    public function addProperty(RouteToAddPropertyRequest $request)
    {
        if($request->isNotAuthentic()){
            return Redirect::to(url('/').'/app/add-property#/');
        }else{
            return Redirect::to(url('/').'/dashboard#/home/properties/add');
        }
    }
    public function update(UpdatePropertyRequest $request)
    {
        return $this->response
            ->setView('userRegistered')
            ->respond($this->PropertyTransformer->transform($request->all()));
    }
    public function search(SearchPropertiesRequest $request)
    {
        $params = $request->getParams();
        $params['sortBy'] = 'updated_at';
        $loggedInUser = $request->user();
        $properties = $this->properties->search($request->getParams());
        $propertiesCount = count($properties);
        $totalPropertiesFound = (new Cheetah())->count();
        $banners = $this->getPropertyListingPageBanners($params);
        return $this->response->setView('frontend.v1.property_listing')->respond(['data' => [
            'properties' => $this->releaseAllPropertiesFiles($properties),
            'totalProperties'=> $totalPropertiesFound[0]->total_records,
            'isFavourite' => $this->getFavourite($loggedInUser,$properties),
            'societies'=>$this->societies->all(),
            'blocks'=>$this->blocks->getBlocksBySociety($request->get('societyId')),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes(),
            'landUnits'=>$this->landUnits->all(),
            'propertiesCount'=>$propertiesCount,
            'cities'=>$this->cities->all(),
            'oldValues'=>$request->all(),
            'banners'=>$banners,
            'selectedLocations' => json_encode($this->locations->getByIds((is_array($params['locationId']))?$params['locationId']:[]))
        ]]);
    }
    private function getLocationPropertiesBySlug($slug)
    {
        $location = $this->locations->getLocationBySlug($slug);
        $city = $this->cities->getCityBySlug(request()->route()->parameter('city_slug'));
        $breadcrumbs = [
                [
                    'title' => $city->city,
                    'destination' => url('properties')."/".$city->slug
                ],
                [
                    'title' => $location->location,
                    'destination' => url('properties')."/".$city->slug."/".$location->slug
                ]
            ];
        $params =  $params =  [
            'wanted' => 0,
            'purposeId' =>null,
            'propertyTypeId' => null,
            'subTypeId' => null,
            'societyId' => null,
            'cityId'=> null,
            'locationId'=>[$location->id],
            'blockId' => null,
            'bedrooms' => null,
            'priceFrom' => null,
            'priceTo' => null,
            'landUnitId' => null,
            'landAreaFrom' => null,
            'landAreaTo' => null,
            'propertyFeatures' => null,
            'page' =>null,
            'limit' => null,
            'sortBy' =>null,
            'order' => null,
        ];
        $loggedInUser = $this->auth->user();
        $properties = $this->properties->search($params);
        $propertiesCount = count($properties);
        $totalPropertiesFound = (new Cheetah())->count();
        $banners = [];//$this->getPropertyListingPageBanners($params);
        return $this->response->setView('frontend.v1.location_property_listing')->respond(['data' => [
            'properties' => $this->releaseAllPropertiesFiles($properties),
            'totalProperties'=> $totalPropertiesFound[0]->total_records,
            'isFavourite' => $this->getFavourite($loggedInUser,$properties),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes(),
            'landUnits'=>$this->landUnits->all(),
            'propertiesCount'=>$propertiesCount,
            'locations'=>$this->locations->getByCity(['cityId'=>$location->city_id]),
            'city'=>$this->locations->getCityLocationCount($location->city_id),
            'cities'=>$this->cities->all(),
            'extraMeta'=>$location,
            'oldValues'=>$params,
            'banners'=>$banners,
            'breadcrumbs' => $breadcrumbs,
            'selectedLocations' => json_encode($this->locations->getByIds((is_array($params['locationId']))?$params['locationId']:[]))
        ]]);
    }
    public function propertySubtypes()
    {
        $collection = collect($this->propertySubtypes->all());
        return json_encode($collection->groupBy('propertyTypeId'));
    }
    public function getFavourite($loggedInUser ,$properties)
    {
        $favourites =[];
        if($loggedInUser == null) {
            return false;
        }
        else{
            foreach($properties as $property)
            {
                $favourites[]=$this->favouriteFactory->isFavourite($property->id, $loggedInUser->id);
            }
            return $favourites;
        }
    }
    public function getPropertyListingPageBanners($params)
    {
        $betweenBanners  = $this->banners->getBanners([
            'bannerType'=>'relevant',
            'position'=>'between',
            'page'=>'property_listing',
            'societyId'=>$params['societyId'],
            'landAreaFrom'=>$params['landAreaFrom'],
            'landAreaTo'=>$params['landAreaTo']
        ]);

        $leftBanners = $this->banners->getBanners([
            'bannerType'=>'relevant',
            'position'=>'left',
            'page'=>'property_listing',
            'landUnitId'=>$params['landUnitId'],
            'societyId'=>$params['societyId'],
            'landAreaFrom'=>$params['landAreaFrom'],
            'landAreaTo'=>$params['landAreaTo']
        ]);
        $topBanners  = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'top',
            'page'=>'property_listing',
            'societyId'=>$params['societyId'],
            'landAreaFrom'=>$params['landAreaFrom'],
            'landAreaTo'=>$params['landAreaTo']
        ]);
        $rightBanners  = $this->banners->getBanners([
            'bannerType'=>'fix',
            'position'=>'right',
            'page'=>'property_listing',

        ]);

        return $banners = [
            'leftBanners'=>$leftBanners,
            'topBanners'=>$topBanners,
            'rightBanners'=>$rightBanners,
            'between'=>$betweenBanners
        ];
    }
    public function getIndexPageBanners()
    {
        return $banners = [
            'sliderBanners'=>$this->banners->getBanners(['bannerType'=>'fix','position'=>'slider','page'=>'index']),
            'leftBanners'=>$this->banners->getBanners(['bannerType'=>'fix','position'=>'left','page'=>'index']),
            'topBanners'=>$this->banners->getBanners(['bannerType'=>'fix','position'=>'top','page'=>'index']),
            'rightBanners'=>$this->banners->getBanners(['bannerType'=>'fix','position'=>'right','page'=>'index'])
        ];
    }
    public function index(IndexRequest $request)
    {
        return $this->response->setView('frontend.v1.index')->respond(['data' =>[
            'cities'=>$this->cities->all(),
            'propertyTypes'=>$this->propertyTypes->all(),
            'propertySubtypes'=>$this->propertySubtypes->all(),
            'landUnits'=>$this->landUnits->all(),
            'agents'=>$this->releaseUsersAgenciesLogo($this->users->getTrustedAgentsWithPriority(['limit'=>36])),
            'importantSocieties'=>$this->societies->getImportantSocieties(),
            'importantCities'=>$this->cities->getImportantCities(),
            'saleAndRentCount'=>$this->propertiesRepo->countSaleAndRendProperties(),
            'projects'=>$this->projectRepo->getAllProjects(),
            'news'=>$this->news->getAllNews(),
            'banners'=>$this->getIndexPageBanners()
        ]]);
    }
    public function getById(GetPropertyRequest $request)
    {
        try {
            $property = $this->properties->getPropertyBySlug($request->get('propertySlug'));
            if ($property->propertyStatus->id == ($this->status->getActiveStatusId())) {
                $this->propertiesRepo->IncrementViews($property->id);
                $loggedInUser = $request->user();
                $property = $this->convertPropertyAreaToActualUnit($property);
                $propertyOwner = $this->users->find($property->owner->id);
                return $this->response->setView('frontend.v1.property_detail')->respond(['data' => [
                    'isFavourite' => ($loggedInUser == null) ? false : $this->favouriteFactory->isFavourite($property->id, $loggedInUser->id),
                    'property' => $this->releaseAllPropertiesFiles([$property])[0],
                    'loggedInUser' => $loggedInUser,
                    'user' => $this->users->find($property->owner->id),
                    'propertyOwner' => $propertyOwner,
                    'banners' => $this->getPropertyDetailPageBanners(),
                    'propertyId' => $property->id,
                    'extraMeta' => $property,
                    'breadcrumb' => $this->propertyBreadcrumbs($property)
                ]]);
            } else {
                return $this->response->setView('frontend.v1.No-result')->respond(['data' => [
                    'propertyId' => $request->get('propertyId')
                ]]);
            }
        }catch(\Exception $e){
            return $this->response->setView('frontend.v1.No-result')->respond(['data' => [
                'propertyId' => $request->get('propertyId')
            ]]);
        }
    }

    public function getPropertyDetailPageBanners()
        {
            $leftBanners = $this->banners->getBanners([
                'bannerType'=>'fix',
                'position'=>'left',
                'page'=>'property_detail'

            ]);

            $topBanners  = $this->banners->getBanners([
                'bannerType'=>'fix',
                'position'=>'top',
                'page'=>'property_detail'
            ]);
            $rightBanners  = $this->banners->getBanners([
                'bannerType'=>'fix',
                'position'=>'right',
                'page'=>'property_detail'
            ]);
            return $banners = [
                'leftBanners'=>$leftBanners,
                'topBanners'=>$topBanners,
                'rightBanners'=>$rightBanners,
            ];
        }
    private function getByCitySlug($slug)
    {
        $city = $this->cities->getCityBySlug($slug);
        $params = array_merge(['cityId'=>$city->id]);
        $breadcrumbs = [
            [
                'title' => $city->city,
                'destination' => url('properties')."/".$city->slug
            ]
        ];
        return $this->response->setView('frontend.v1.locations')->respond(['data'=>[
            'locations'=>$this->locations->getByCity($params),
            'city'=>$this->locations->getCityLocationCount($city->id),
            'locationCount'=>$this->locations->locationCount()[0]->total_records,
            'extraMeta'=>$city,
            'breadcrumbs' => $breadcrumbs
        ]]);
    }
    public function fetchProperties()
    {
        $citySlug = request()->route()->parameter('city_slug');
        $locationSlug = request()->route()->parameter('location_slug');
         try{
             if($locationSlug != null){
                 return $this->getLocationPropertiesBySlug($locationSlug);
             }else{
                 return $this->getByCitySlug($citySlug);
             }
         }catch (\Exception $e){
             return Redirect::to('properties');
         }
    }

    public function getGeneralProperties()
    {
        return 'new properties page';
    }
}
