<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Agency;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AgencyValidators\GetAllAgenciesValidator;
use App\Transformers\Request\Agency\GetAllAgenciesTransformer;

class GetAllAgenciesRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllAgenciesTransformer($this->getOriginalRequest()));
        $this->validator = new GetAllAgenciesValidator($this);
    }
    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 