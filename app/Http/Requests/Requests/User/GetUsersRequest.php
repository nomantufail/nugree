<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Transformers\Request\User\GetUsersTransformer;

class GetUsersRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetUsersTransformer($this->getOriginalRequest()));

        $this->validator = null;
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return true;
    }

} 