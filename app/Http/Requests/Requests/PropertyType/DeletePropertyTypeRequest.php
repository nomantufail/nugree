<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyType;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyTypeValidators\DeletePropertyTypeValidator;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Repositories\Sql\PropertyTypeRepository;
use App\Transformers\Request\PropertyPurpose\DeletePropertyPurposeTransformer;
use App\Transformers\Request\PropertyType\DeletePropertyTypeTransformer;

class DeletePropertyTypeRequest extends Request implements RequestInterface{

    public $validator = null;
    private $propertyType = null;
    public function __construct(){
        parent::__construct(new DeletePropertyTypeTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertyTypeValidator($this);
        $this->propertyType = (new PropertyTypesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getPropertyTypeModel()
    {
        return $this->propertyType->getById($this->get('id'));
    }

} 