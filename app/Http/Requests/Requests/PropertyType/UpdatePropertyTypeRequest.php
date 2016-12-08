<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyType;

use App\DB\Providers\SQL\Models\PropertyType;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyTypeValidators\UpdatePropertyTypeValidator;
use App\Transformers\Request\PropertyType\UpdatePropertyTypeTransformer;

class UpdatePropertyTypeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdatePropertyTypeTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertyTypeValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return PropertyType::class
     * */
    public function getPropertyTypeModel()
    {
        $propertyType = new PropertyType();
        $propertyType->id = $this->get('id');
        $propertyType->name = $this->get('propertyType');
        return $propertyType;
    }

} 