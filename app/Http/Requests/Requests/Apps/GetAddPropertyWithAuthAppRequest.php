<?php
/**
 * Created by waqas.
 * User: waqas
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Apps;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AppsValidators\GetAddPropertyWithAuthAppValidator;
use App\Http\Validators\Validators\AppsValidators\GetDashboardAppValidator;
use App\Transformers\Request\Apps\GetAddPropertyWithAuthAppTransformer;
use App\Transformers\Request\Apps\GetDashboardAppTransformer;

class GetAddPropertyWithAuthAppRequest extends AppsRequest implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAddPropertyWithAuthAppTransformer($this->getOriginalRequest()));
        $this->validator =  new GetAddPropertyWithAuthAppValidator($this);
    }

    public function version()
    {
        return 'v2';
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 