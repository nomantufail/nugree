<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;


use App\DB\Providers\SQL\Models\Features\FeatureWithValidationRules;
use App\Http\Validators\Interfaces\ValidatorsInterface;
use Illuminate\Support\Facades\Validator;
use Psy\Exception\FatalErrorException;

class AddPropertyValidator extends PropertyValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);

    }
     /**
     * @return array
     */
    public function customValidationMessagesForExtraFeatures()
    {
        $customMessages = [];
        $features = $this->getExtraFeatures();
        foreach($features as $feature /* @var $feature FeatureWithValidationRules::class*/)
        {
            $featureCustomMessages = $feature->customErrorMessages();
            foreach($featureCustomMessages as $key => $message){
                $customMessages['features.'.$key] = $message;
            }
        }

        return $customMessages;
    }

    public function CustomValidationMessages(){
        return array_merge([
            /* exists messages */
            'ownerId.exists' => 'Owner is invalid',
            'purposeId.exists' => 'Property purpose is invalid',
            'subTypeId.exists' => 'Property sub type is invalid',
            'blockId.exists' => 'Block is invalid',
            'landUnitId.exists' => 'Land unit is invalid',

            /* required messages */
            'ownerId.required' => 'property owner is required',
            'purposeId.required' => 'Property purpose is required',
            'subTypeId.required' => 'Property sub type is required',
            'locationId.required' => 'LocationValidators is required',
            'landUnitId.required' => 'Land unit is required',
            'title.required' => 'Property title is required',
            'description.required' => 'property description is required',
            'price.required' => 'property price is required',
            'landArea.required' => 'land area is required',
            'contactPerson.required' => 'contact person is required',
            'phone.required' => 'company phone is required',
            'mobile.required' => 'cell number is required',
            'email.required' => 'company email is required',
            'files.addProperty_max_image_size'=> 'Invalid Image or Image Size is too big'
        ], $this->customValidationMessagesForExtraFeatures());
    }

    private function propertyInfoRules()
    {
        return [
            //'files'=>'addProperty_max_image_size',
            'ownerId' => 'required|exists:users,id',
            'purposeId' => 'required|exists:property_purposes,id',
            'subTypeId' => 'required|exists:property_sub_types,id',
            'locationId' => 'required|exists:locations,id',
            'title' => 'required|min:3|max:250',
            'description' => 'max:1200',
            'price' => 'required|numeric|min:3',
            'landArea' => 'required|numeric',
            'landUnitId' => 'required|exists:land_units,id',
        ];
    }

    private function propertyContactInfoRules()
    {
        return [
            'contactPerson' => 'required',
            'phone' => 'max:15',
            'mobile' => 'required|max:15',
            'email' => 'required|email'
        ];
    }

    private function extraFeaturesValidationRules()
    {
        $features = $this->getExtraFeatures();
        $rules = [];
        foreach($features as $feature /* @var $feature FeatureWithValidationRules::class */)
        {
            $featureRules = $feature->rulesToString();
            if(!empty($featureRules) > 0)
            {
                $rules['features.'.$feature->featureInputName] = $featureRules;
            }
        }
        return $rules;
    }

    public function rules()
    {
        return array_merge(array_merge($this->propertyInfoRules(),$this->propertyContactInfoRules()), $this->extraFeaturesValidationRules());
    }
}
