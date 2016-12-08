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
use App\Http\Validators\Validators\PropertySubTypeValidators\UpdatePropertySubTypeValidator;
use App\Transformers\Request\PropertySubType\UpdatePropertySubTypeTransformer;

class UpdatePropertySubTypeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdatePropertySubTypeTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertySubTypeValidator($this);
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
        $propertySubType->id = $this->get('id');
        $propertySubType->name = $this->get('propertySubTypeName');
        $propertySubType->propertyTypeId= $this->get('propertyTypeId');
        return $propertySubType;
    }

} 