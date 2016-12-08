<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertySubTypeValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class AssignFeatureValidator extends PropertySubTypeValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function CustomValidationMessages(){
        return [
            'featureId.unique'=>'This Feature has Already been Assigned',
        ];
    }
    public function rules()
    {
        return[
            'featureId' => 'required|exists:property_features,id|unique:property_sub_type_assigned_features,property_feature_id,NULL,id,property_sub_type_id,' .$this->request->get('propertySubTypeId'),
            'propertySubTypeId' =>'required|exists:property_sub_types,id'
        ];
    }
}

