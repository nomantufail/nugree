<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Project;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\ProjectValidators\GetAllProjectsValidator;
use App\Transformers\Request\Project\GetAllProjectsTransformer;


class GetAllProjectsRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetAllProjectsTransformer($this->getOriginalRequest()));
                $this->validator = new GetAllProjectsValidator($this->getOriginalRequest());
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }


} 