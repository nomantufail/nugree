<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyPurposes;

use App\DB\Providers\SQL\Models\PropertyPurpose;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyPurposeValidators\AddPropertyPurposeValidator;
use App\Transformers\Request\PropertyPurpose\AddPropertyPurposeTransformer;

class AddPropertyPurposeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddPropertyPurposeTransformer($this->getOriginalRequest()));
        $this->validator = new AddPropertyPurposeValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return propertyPurpose::class
     * */
    public function getPropertyPurposeModel()
    {
        $propertyPurpose = new PropertyPurpose();
        $propertyPurpose->name = $this->get('purpose');
        return $propertyPurpose;
    }

} 