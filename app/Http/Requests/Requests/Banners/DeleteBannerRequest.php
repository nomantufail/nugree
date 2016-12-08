<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Banners;


use App\DB\Providers\SQL\Models\Banner;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\BannerValidators\AddBannerValidator;
use App\Http\Validators\Validators\BannerValidators\DeleteBannersValidator;
use App\Transformers\Request\Banners\AddBannerTransformer;
use App\Transformers\Request\Banners\DeleteBannersTransformer;


class DeleteBannerRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new DeleteBannersTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteBannersValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 