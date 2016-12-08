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
use App\Http\Validators\Validators\ProjectValidators\GetProjectValidator;
use App\Transformers\Request\Project\GetProjectTransformer;


class GetProjectRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetProjectTransformer($this->getOriginalRequest()));
        $this->validator = new GetProjectValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 