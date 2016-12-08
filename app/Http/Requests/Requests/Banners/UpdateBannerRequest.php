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
use App\Http\Validators\Validators\BannerValidators\UpdateBannersValidator;
use App\Repositories\Providers\Providers\BannersRepoProvider;
use App\Transformers\Request\Banners\AddBannerTransformer;
use App\Transformers\Request\Banners\DeleteBannersTransformer;
use App\Transformers\Request\Banners\UpdateBannersTransformer;


class UpdateBannerRequest extends Request implements RequestInterface{

    public $validator;
    public $bannerRepo;
    public $bannersSocieties = null;
    public $bannerPages = null;
    public $bannerSize = null;
    public function __construct(){
        parent::__construct(new UpdateBannersTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateBannersValidator($this);
        $this->bannerRepo = (new BannersRepoProvider())->repo();
        $this->bannersSocieties = (new BannersRepoProvider())->bannerSocieties();
        $this->bannerPages = (new BannersRepoProvider())->bannerPages();
        $this->bannerSize = (new BannersRepoProvider())->bannerSizes();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getBannerModel()
    {
        $banner = $this->bannerRepo->getBanner($this->get('id'));

        if($this->get('bannerImage') !=null && $this->get('bannerImage') !="")
        {
            $banner->image = $this->getImageName($this->get('bannerImage'));
        }
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