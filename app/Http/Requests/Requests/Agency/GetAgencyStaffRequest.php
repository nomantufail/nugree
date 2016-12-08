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
use App\Http\Validators\Validators\AgencyValidators\GetAgencyStaffsValidator;
use App\Transformers\Request\Agency\GetAgencyStaffsTransformer;


class GetAgencyStaffRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAgencyStaffsTransformer($this->getOriginalRequest()));
        $this->validator = new GetAgencyStaffsValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 