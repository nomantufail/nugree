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
use App\Http\Validators\Validators\PropertyPurposeValidators\UpdatePropertyPurposeValidator;
use App\Transformers\Request\PropertyPurpose\UpdatePropertyPurposeTransformer;


class UpdatePropertyPurposeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdatePropertyPurposeTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertyPurposeValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return PropertyPurpose::class
     * */
    public function getPropertyPurposeModel()
    {
        $purpose = new PropertyPurpose();
        $purpose->id = $this->get('id');
        $purpose->name = $this->get('purpose');
        return $purpose;
    }

} 