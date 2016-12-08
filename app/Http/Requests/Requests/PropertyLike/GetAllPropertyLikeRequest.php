<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyLike;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyLikeValidators\GetAllPropertyLikeValidator;
use App\Transformers\Request\PropertyLike\GetAllPropertyLikeTransformer;

class GetAllPropertyLikeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllPropertyLikeTransformer($this->getOriginalRequest()));
        $this->validator = new GetAllPropertyLikeValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 