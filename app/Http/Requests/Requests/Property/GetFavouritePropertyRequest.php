<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Models\Property;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyValidators\GetFavouritePropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\GetPropertyValidator;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Transformers\Request\Property\GetFavouritePropertyTransformer;
use App\Transformers\Request\Property\GetPropertyTransformer;


class GetFavouritePropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetFavouritePropertyTransformer($this->getOriginalRequest()));
        $this->validator = new GetFavouritePropertyValidator($this);

    }
    public function authorize(){

        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
}