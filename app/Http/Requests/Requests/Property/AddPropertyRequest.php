<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\CityValidators\AddCityValidator;
use App\Http\Validators\Validators\PropertyValidators\AddPropertyValidator;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Providers\Providers\LandUnitsRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Repositories\Repositories\Sql\PropertySubTypeRepository;
use App\Transformers\Request\City\AddCityTransformer;
use App\Transformers\Request\Property\AddPropertyTransformer;

class AddPropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    private $features = null;
    private $statusSeeder = null;

    public function __construct()
    {
        parent::__construct(new AddPropertyTransformer($this->getOriginalRequest()));
        $this->validator = new AddPropertyValidator($this);
        $this->features = (new FeaturesRepoProvider())->repo();
        $this->statusSeeder = new \PropertyStatusTableSeeder();
        $this->location = (new LocationsRepoProvider())->repo();
        $this->city = (new CitiesRepoProvider())->repo();
        $this->landUnit = (new LandUnitsRepoProvider())->repo();
        $this->subType = new PropertySubTypeRepository();
        $this->properties = (new PropertiesRepoProvider())->repo();
    }

    public function getPropertyModel()
    {
        $property = new Property();
        $property->purposeId = $this->get('purposeId');
        $property->subTypeId =  $this->get('subTypeId');
        $property->locationId =  $this->get('locationId');
        $property->title =  $this->get('title');
        $property->description =  $this->get('description');
        $property->price =  $this->get('price');
        $property->landArea =  $this->get('landArea');
        $property->landUnitId =  $this->get('landUnitId');
        $property->statusId = $this->statusSeeder->getPendingStatusId(); /* its temporary */

        $property->contactPerson =  $this->get('contactPerson');
        $property->phone =  $this->get('phone');
        $property->mobile =  $this->get('mobile');
        $property->email =  $this->get('email');
        $property->fax =  $this->get('fax');
        $property->wanted = ($this->get('wanted') != null)?1:0;
        $property->ownerId = $this->get('ownerId');
        $property->totalViews = rand(0,170);
        $property->isVerified = 0;
        $property->createdBy = $this->user()->id;
        $property->createdAt = date('Y-m-d h:i:s');
        $property->updatedAt = date('Y-m-d h:i:s');

        return $property;
    }
    public function getFeaturesValues($propertyId)
    {
        $submittedFeatures = $this->getSubmittedPropertyFeatures();
        $featureValues = [];
        foreach($submittedFeatures as $feature /* @var $feature Feature */)
        {
            $featureValue = new PropertyFeatureValue();
            $featureValue->propertyId = $propertyId;
            $featureValue->propertyFeatureId = $feature->id;
            $featureValue->value = $this->getFeature($feature->inputName);
            $featureValue->updatedAt = date('Y-m-d h:i:s');
            $featureValues[] = $featureValue;
        }
        return $featureValues;
    }

    public function getSubmittedPropertyFeatures()
    {
        $features = $this->features->getBySubType($this->get('subTypeId'));
        $finalFeatures = [];
        foreach($features as $feature /* @var $feature Feature */)
        {
            if($this->getFeature($feature->inputName) != null)
                $finalFeatures[] = $feature;
        }
        return $finalFeatures;
    }

    public function getFiles()
    {
        $files = [];
        foreach($this->get('files') as $key => $file)
        {
            if($file['file'] != "null")
                $files[$key] = $file;
        }
        return $files;
    }
    public function getPropertyDocuments($propertyId = null)
    {
        $documents = [];

        $document = new PropertyDocument();
        $document->propertyId = $propertyId;
        $document->path = 'its a path';
        $document->title = 'bedrooms';

        $documents[] = $document;

        return $documents;
    }

    public function getFeature($featureName)
    {
        $features = $this->get('features');
        return (isset($features[$featureName])) ? $features[$featureName] : null;
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 