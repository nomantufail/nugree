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
use App\Transformers\Request\Banners\AddBannerTransformer;


class AddBannerRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new AddBannerTransformer($this->getOriginalRequest()));
        $this->validator = new AddBannerValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getBannerModel()
    {
        $banner = new Banner();
        $banner->image = $this->getImageName($this->get('bannerImage'));
        $banner->bannerPriority = $this->get('priority');
        $banner->bannerType = $this->get('type');
        $banner->position = $this->get('position');
        $banner->bannerLink = $this->get('bannerLink');
        return $banner;
    }
    public function getImageName($originalName)
    {
        if(isset($originalName)) {
            $extension = $originalName->getClientOriginalExtension();
            $imageName = md5($originalName->getClientOriginalName()) . '.' . $extension;
            $originalName->move(public_path() . '/assets/imgs/42_ads', $imageName);
            return 'assets/imgs/42_ads/' . $imageName;
        }
        return '';
    }

} 