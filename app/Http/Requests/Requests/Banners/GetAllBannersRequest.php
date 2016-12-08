<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Banners;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\BannerValidators\GetAllBannersValidator;
use App\Transformers\Request\Banners\GetAllBannersTransformer;


class GetAllBannersRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetAllBannersTransformer($this->getOriginalRequest()));
                $this->validator = new GetAllBannersValidator($this->getOriginalRequest());
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }


} 