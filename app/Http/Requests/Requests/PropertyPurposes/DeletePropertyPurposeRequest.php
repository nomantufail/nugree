<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyPurposes;

use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;

use App\Http\Validators\Validators\PropertyPurposeValidators\DeletePropertyPurposeValidator;
use App\Repositories\Providers\Providers\PropertyPurposesRepoProvider;
use App\Repositories\Repositories\Sql\PropertyPurposeRepository;
use App\Transformers\Request\PropertyPurpose\DeletePropertyPurposeTransformer;

class DeletePropertyPurposeRequest extends Request implements RequestInterface{

    public $validator = null;
    private $purpose = null;
    public function __construct(){
        parent::__construct(new DeletePropertyPurposeTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertyPurposeValidator($this);
        $this->purpose = (new PropertyPurposesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getPropertyPurposeModel()
    {
        return $this->purpose->getById($this->get('id'));
    }

} 