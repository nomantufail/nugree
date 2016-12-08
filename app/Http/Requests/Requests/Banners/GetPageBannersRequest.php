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
use App\Http\Validators\Validators\BannerValidators\GetPageBannersValidator;
use App\Transformers\Request\Banners\GetAllBannersTransformer;
use App\Transformers\Request\Banners\GetPageBannersTransformer;


class GetPageBannersRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetPageBannersTransformer($this->getOriginalRequest()));
                $this->validator = new GetPageBannersValidator($this->getOriginalRequest());
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }


} 