<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertySubType;



use App\DB\Providers\SQL\Models\PropertySubType;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertySubTypeValidators\AddPropertySubTypeValidator;
use App\Transformers\Request\PropertySubType\AddPropertySubTypeTransformer;

class AddPropertySubTypeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddPropertySubTypeTransformer($this->getOriginalRequest()));
        $this->validator = new AddPropertySubTypeValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return PropertySubType::class
     * */
    public function getPropertySubTypeModel()
    {
        $propertySubType = new PropertySubType();
        $propertySubType->propertyTypeId = $this->get('propertyTypeId');
        $propertySubType->name = $this->get('propertySubTypeName');
        return $propertySubType;
    }

} 