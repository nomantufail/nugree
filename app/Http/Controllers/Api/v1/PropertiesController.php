<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\DB\Providers\SQL\Models\User;
use App\Events\Events\Property\PropertyCreated;
use App\Events\Events\Property\PropertyDeleted;
use App\Events\Events\Property\PropertyBasicInfoUpdated;
use App\Events\Events\Property\PropertyUpdated;
use App\Http\Requests\Requests\AddToFavourite\AddToFavouriteRequest;
use App\Http\Requests\Requests\AddToFavourite\DeleteMultiFavouritePropertyRequest;
use App\Http\Requests\Requests\AddToFavourite\DeleteToFavouritePropertyRequest;
use App\Http\Requests\Requests\Property\AddPropertyRequest;
use App\Http\Requests\Requests\Property\AddPropertyWithAuthRequest;
use App\Http\Requests\Requests\Property\AdvanceSearchUserPropertiesRequest;
use App\Http\Requests\Requests\Property\CountPropertiesRequest;
use App\Http\Requests\Requests\Property\DeleteMultiplePropertiesRequest;
use App\Http\Requests\Requests\Property\DeletePropertyRequest;
use App\Http\Requests\Requests\Property\ForceDeleteMultiplePropertiesRequest;
use App\Http\Requests\Requests\Property\ForceDeletePropertyRequest;
use App\Http\Requests\Requests\Property\GetFavouritePropertyRequest;
use App\Http\Requests\Requests\Property\GetUserPropertiesRequest;
use App\Http\Requests\Requests\Property\RestorePropertyRequest;
use App\Http\Requests\Requests\Property\SearchPropertiesRequest;
use App\Http\Requests\Requests\Property\UpdatePropertyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Libs\Auth\Api as Authenticator;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\PropertyDocumentsRepository;
use App\Repositories\Repositories\Sql\PropertyFeatureValuesRepository;
use App\Traits\FileCompresser;
use App\Traits\Property\PropertyPriceUnitHelper;
use App\Traits\SlugBuilder;
use App\Transformers\Response\PropertyJson\PropertyJsonTransformer;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PropertiesController extends ApiController
{
    use \App\Traits\Property\PropertyFilesReleaser, PropertyPriceUnitHelper, FileCompresser, SlugBuilder;

    private $auth = null;
    private $properties = null;
    private $propertyFeatureValues = null;
    public  $response = null;
    private $propertyDocuments = null;
    private $propertiesJsonRepo = null;
    private $propertyJsonTransformer = null;
    private $propertyRepo = null;
    private $usersJsonRepo = null;
    private $users = null;
    /**
     * @param PropertiesRepoProvider $repoProvider
     * @param ApiResponse $response
     */
    public function __construct(PropertiesRepoProvider $repoProvider,ApiResponse $response)
    {
        $this->auth = new Authenticator();
        $this->properties = $repoProvider->repo();
        $this->propertyRepo = (new PropertiesRepoProvider())->repo();
        $this->response = $response;
        $this->propertyFeatureValues = new PropertyFeatureValuesRepository();
        $this->propertyDocuments = new PropertyDocumentsRepository();
        $this->propertiesJsonRepo= (new PropertiesJsonRepoProvider())->repo();
        $this->propertyJsonTransformer = new PropertyJsonTransformer();
        $this->usersJsonRepo= (new UsersJsonRepoProvider())->repo();
        $this->users = (new UsersRepoProvider())->repo();
    }

    public function store(AddPropertyRequest $request)
    {
        $property = $this->convertPropertyAreaToLowestUnit($request->getPropertyModel());
        $propertyId = $this->properties->store($property);
        $this->propertyFeatureValues->storeMultiple($request->getFeaturesValues($propertyId));
        $property->id = $propertyId;
        $this->storeFiles($request->getFiles(), $this->inStoragePropertyDocPath($property), $propertyId);
        Event::fire(new PropertyCreated($property));
        $property->slug = $this->propertySlug($this->convertPropertyAreaToActualUnit($this->propertiesJsonRepo->getById($propertyId)));
        $this->properties->update($property);
        Event::fire(new PropertyBasicInfoUpdated($property,$this->propertiesJsonRepo->getById($propertyId)));
        return $this->response->respond(['data' => [
            'property' => $property,
            'features' => $request->getFeaturesValues($propertyId),
            'propertiesCounts' => $this->properties->countProperties($request->user()->id)
        ]]);
    }

    private function storePropertyCompletely($request, $property)
    {
        $propertyId = $this->properties->store($property);
        $this->propertyFeatureValues->storeMultiple($request->getFeaturesValues($propertyId));
        $property->id = $propertyId;
        $this->storeFiles($request->getFiles(), $this->inStoragePropertyDocPath($property), $propertyId);
        $property = $this->properties->getById($propertyId);
        Event::fire(new PropertyCreated($property));
        $property->slug = $this->propertySlug($this->convertPropertyAreaToActualUnit($this->propertiesJsonRepo->getById($propertyId)));
        $this->properties->update($property);
        Event::fire(new PropertyBasicInfoUpdated($property,$this->propertiesJsonRepo->getById($propertyId)));
        return $property;
    }

    public function storeWithAuth(AddPropertyWithAuthRequest $request)
    {

        try{
            $user = (!$request->isMember())?$this->registerAndLogin($request->getUserModel()):$this->loginUser($this->users->findByEmail($request->get('loginDetails')['email']));
            $property = $this->storePropertyCompletely($request, $this->convertPropertyAreaToLowestUnit($request->getPropertyModel($user)));
        }catch (\Exception $e){
            return $this->response->respondInternalServerError();
        }
        return $this->response->respond(['data' => [
            'property' => $property,
            'features' => $request->getFeaturesValues($property->id),
            'propertiesCounts' => $this->properties->countProperties($user->id)
        ]]);

    }

    private function registerAndLogin(User $user)
    {
        $user = $this->users->store($user);
        $this->users->addRoles($user->id, [1]);

        return $this->loginUser($user);
    }

    private function loginUser(User $user)
    {
        return $this->auth->login($user);
    }

    public function getFavouriteProperties(GetFavouritePropertyRequest $request)
    {
        $params = $request->all();
        $favouriteProperties = $this->propertiesJsonRepo->getFavouriteProperties($params);
        $totalCount = count($favouriteProperties);
        return $this->response->respond(['data'=>[
            'properties'=>$favouriteProperties,
            'favouritesCount'=>$totalCount
        ]]);
    }
    public function update(UpdatePropertyRequest $request)
    {
        $property = $this->convertPropertyAreaToLowestUnit($request->getPropertyModel());
        $this->properties->update($property);
        $this->propertyFeatureValues->updatePropertyFeatures($property->id, $request->getFeaturesValues($property->id));
        $this->updatePropertyFiles($request->getFiles(), $this->inStoragePropertyDocPath($property), $property->id);
        if(is_array($request->get('deletedFiles'))){$this->deleteByIds($request->get('deletedFiles'));}
        Event::fire(new PropertyUpdated($property));
        return $this->response->respond(['data'=>[
            'property'=>$this->releasePropertiesJsonFiles($this->propertiesJsonRepo->getUserProperties(['propertyId'=>$property->id]))[0]
        ]]);
    }

    public function delete(DeletePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->delete($property);
        Event::fire(new PropertyUpdated($property));

        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'property'=>$property,
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }

    public function forceDelete(ForceDeletePropertyRequest $request)
    {
        $property = $request->getPropertyModel();
        $this->properties->forceDelete($property);
        Event::fire(new PropertyDeleted($property));
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'property'=>$property,
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }

    public function deleteMultiFavouriteProperty(DeleteMultiFavouritePropertyRequest $request)
    {
        $params = $request->all();
        $this->properties->multiDeleteFavouriteProperty($params['propertyIds'],$params['userId']);
        $favouriteProperties = $this->propertiesJsonRepo->getFavouriteProperties($params);
        $totalCount = count($favouriteProperties);
        return $this->response->respond(['data'=>[
            'properties'=>$favouriteProperties,
            'favouritesCount'=>$totalCount
        ]]);
    }

    public function multiDelete(DeleteMultiplePropertiesRequest $request)
    {
        $propertyIds = $request->get('propertyIds');
        $this->properties->deleteByIds($propertyIds);
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }
    public function multiForceDelete(ForceDeleteMultiplePropertiesRequest $request)
    {
        $propertyIds = $request->get('propertyIds');
        $this->properties->forceDeleteByIds($propertyIds);
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' =>$propertiesCounts,
            'properties'=>$userProperties,
        ]]);
    }

    public function restore(RestorePropertyRequest $request)
    {
        $this->propertyRepo->restoreProperty($this->propertyRepo->getById($request->get('propertyId')));
        $userProperties = $this->propertiesJsonRepo->getUserProperties($request->get('searchParams'));
        $countUserSearchProperties = $this->propertiesJsonRepo->countSearchedUserProperties($request->get('searchParams'));
        $propertiesCounts  = $this->properties->countProperties($request->get('searchParams')['ownerId']);
        return $this->response->respond(['data'=>[
            'property'=>$this->propertiesJsonRepo->getById($request->get('propertyId')),
            'totalProperties'=>$countUserSearchProperties,
            'propertiesCounts' => $propertiesCounts,
            'properties'=>$userProperties
        ]]);
    }

    public function getUserProperties(GetUserPropertiesRequest $request)
    {
        $properties = $this->convertPropertiesAreaToActualUnit($this->propertiesJsonRepo->getUserProperties($request->all()));
        $properties = $this->releaseAllPropertiesFiles($properties);
        return $this->response->respond(['data' => [
            'properties' => $this->propertyJsonTransformer->transformCollection($properties),
            'totalProperties' => $this->propertiesJsonRepo->countSearchedUserProperties($request->all())
        ]]);
    }

    public function updatePropertyFiles(array $files, $path, $propertyId)
    {
        $deletableFiles = [];
        $storableFiles = [];
        foreach($files as $key=>$file)
        {
            if($file['file'] != 'null')
            {
                $storableFiles[$key] = $file;
                $deletableFiles[$key] = $file;
            }
        }
        $this->deletePropertyFiles($deletableFiles);
        $this->storeFiles($storableFiles, $path, $propertyId);
        $this->updateFilesPath($files);
    }

    public function updateFilesPath(array $files)
    {
        $ids = [];
        foreach($files as $file){ $ids[] = $file['id']; }
        $previousDocuments = $this->propertyDocuments->getByIds($ids);
        $updateableDocuments = [];
        foreach($previousDocuments as $pDocument)
        {
            foreach($files as $file){
                if($pDocument->id == $file['id'] && $pDocument->title != $file['title']){
                    $pDocument->title = $file['title'];
                    $updateableDocuments[] = $pDocument;
                }
            }
        }
        foreach($updateableDocuments as $document)
        {
            $this->propertyDocuments->update($document);
        }
    }
    public function deletePropertyFiles(array $files)
    {
        $ids = [];
        foreach($files as $file){ $ids[] = $file['id']; }
        $previousDocuments = $this->propertyDocuments->getByIds($ids);
        $this->deleteDocuments($previousDocuments);
    }

    public function deleteByIds(array $ids)
    {
        return $this->deleteDocuments($this->propertyDocuments->getByIds($ids));
    }

    public function deleteDocuments(array $documents)
    {
        $ids = Helper::propertyToArray($documents, 'id');
        foreach($documents as $document /* @var $document PropertyDocument::class */)
        {
            File::delete(storage_path('app/').$document->path);
        }
        return $this->propertyDocuments->deleteByIds($ids);
    }

    public function storeFiles(array $files, $path, $propertyId)
    {
        $propertyDocuments = [];
        foreach($files as $key => $file)
        {
            $document = new PropertyDocument();
            $document->path = $this->storeFileInDirectory(Image::make($file['file']), $path);
            $document->propertyId = $propertyId;
            $document->type = 'image';
            $document->title = isset($file['title'])?$file['title']:'';
            $document->main = ($key == 'mainFile')?true:false;
            $propertyDocuments[] = $document;
        }
        return $this->propertyDocuments->storeMultiple($propertyDocuments);
    }

    public function storeFileInDirectory($file, $path)
    {
//        $secureName = $this->getSecureFileName($file).'.'.$file->getClientOriginalExtension();
//        $file->move(storage_path('app/').$path, $secureName);
//        return $path.'/'.$secureName;
        $secureName = uniqid('img_');
        $directoryToSave = storage_path('app/'.$path);
        if (!file_exists($directoryToSave)) {  mkdir($directoryToSave, 0777, true); }
        $this->compressImage($file)->save($directoryToSave.'/'.$secureName.'.jpg');
        return $path.'/'.$secureName.'.jpg';
    }

    /**
     * @param $file
     * @return string
     */
    private function getSecureFileName($file)
    {
        return str_replace('.', '-',urlencode(bcrypt($file->getClientOriginalName())));
    }

    private function inStoragePropertyDocPath(Property $property)
    {
        return 'users/'.md5($property->ownerId).'/properties/'.md5($property->id);
    }

    public function countProperties(CountPropertiesRequest $countPropertiesRequest)
    {
        $user = $countPropertiesRequest->getUserModel();
        return $this->response->respond(['data'=>[
            'counts'=>$this->properties->countProperties($user->id)]]);
    }

    public function favouriteProperty(AddToFavouriteRequest $request)
    {
       return $this->response->respond(['data'=>[
            'favouriteProperty'=>$this->properties->favouriteProperty($request->favouriteProperty())
       ]]);
    }

    public function deleteFavouriteProperty(DeleteToFavouritePropertyRequest $request)
    {
        $params = $request->all();
        $this->properties->deleteFavouriteProperty($params);
        $favouriteProperties = $this->propertiesJsonRepo->getFavouriteProperties($params);
        $totalCount = count($favouriteProperties);
        return $this->response->respond(['data'=>[
            'properties'=>$favouriteProperties,
            'favouritesCount'=>$totalCount
        ]]);
    }
    public function search(SearchPropertiesRequest $request)
    {
        return $this->propertiesJsonRepo->search($request->getParams());
    }
    public function advanceSearchUserProperties(AdvanceSearchUserPropertiesRequest $request)
    {
        $params = $request->getParams();
        $params['ownerIds'] = Helper::propertyToArray($this->usersJsonRepo->getStaffSiblings($request->get('userId')), 'id');
        unset($params['userId']);
        $properties = $this->propertiesJsonRepo->search($params);
        return $properties;
    }
}