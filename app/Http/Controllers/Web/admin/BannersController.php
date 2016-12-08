<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Banners\AddBannerRequest;
use App\Http\Requests\Requests\Banners\DeleteBannerRequest;
use App\Http\Requests\Requests\Banners\GetAllBannersRequest;
use App\Http\Requests\Requests\Banners\GetBannerRequest;
use App\Http\Requests\Requests\Banners\GetPageBannersRequest;
use App\Http\Requests\Requests\Banners\UpdateBannerRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\BannersRepoProvider;
use App\Repositories\Providers\Providers\PagesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;

class BannersController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper;
    public $users = null;
    public $response = null;
    public $societyRepo=null;
    public $pagesRepo = null;
    public $bannersRepo = null;
    public $bannersSocieties = null;
    public $bannerPages = null;
    public $bannerSize = null;

    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->societyRepo = (new SocietiesRepoProvider())->repo();
        $this->pagesRepo = (new PagesRepoProvider())->repo();
        $this->bannersRepo = (new BannersRepoProvider())->repo();
        $this->bannersSocieties = (new BannersRepoProvider())->bannerSocieties();
        $this->bannerPages = (new BannersRepoProvider())->bannerPages();
        $this->bannerSize = (new BannersRepoProvider())->bannerSizes();

    }
    public function banners()
    {
        return $this->response->setView('admin.banners.banners')->respond(['data'=>[
            'societies'=>$this->societyRepo->all(),
            'pages'=>$this->pagesRepo->all()
        ]]);
    }
    public function bannersListing(GetAllBannersRequest $request)
    {
        return $this->response->setView('admin.banners.banners-listing')->respond(['data'=>[
            'banners'=>$this->bannersRepo->getAllBanners($request->all()),
            'bannerCounts'=>($this->bannersRepo->bannerCount()[0]->total_records),
            'pages'=>$this->pagesRepo->all()
        ]]);
    }
    public function pageBanners(GetPageBannersRequest $request)
    {
        $banners =$this->bannersRepo->getPageBanners($request->all());
        $bannerCount = ($this->bannersRepo->bannerCount()[0]->total_records);
        return $this->response->setView('admin.banners.banners-listing')->respond(['data'=>[
            'banners'=>$banners,
            'pages'=>$this->pagesRepo->all(),
            'bannerCounts'=>$bannerCount
        ]]);
    }
    public function deleteBanner(DeleteBannerRequest $request)
    {
        $this->bannersRepo->delete($request->get('bannerId'));
        return redirect('maliksajidawan786@gmail.com/banners/listing');
    }
    public function getUpdateBannerForm(GetBannerRequest $request)
    {
        return $this->response->setView('admin.banners.update-banners')->respond(['data'=>[
            'societies'=>$this->societyRepo->all(),
            'pages'=>$this->pagesRepo->all(),
            'bannerSocieties'=> Helper::propertyToArray(($this->bannersSocieties->getByBanner($request->get('bannerId'))),'society_id'),
            'bannerPages'=>Helper::propertyToArray(($this->bannerPages->getByBannerId($request->get('bannerId'))),'page_id'),
            'bannersSize'=>$this->bannerSize->getByBanner($request->get('bannerId')),
            'banner'=>$banner = $this->bannersRepo->getBanner($request->get('bannerId'))
        ]]);
    }
    public function updateBanner(UpdateBannerRequest $request)
    {
        $this->bannersRepo->updateBanner($request->getBannerModel());
        $bannerId = $request->get('id');
        if($request->get('societiesIds') !=null)
        {
            if( $request->get('societiesIds')[0] =="")
            {
                $this->bannersSocieties->deleteBannerSocieties($bannerId);
            }
             else
             {
                $this->bannersSocieties->deleteBannerSocieties($bannerId);
                $this->saveBannerSocieties($request->get('societiesIds'),$bannerId);
             }
        }
        if($request->get('area') !=null )
        {
            if($request->get('area')[0] =="")
            $this->bannerSize->deleteBannerSize($bannerId);

            else{
                $this->bannerSize->deleteBannerSize($bannerId);
                $this->saveBannerSizes($bannerId,$request->get('area'),$request->get('unit'));
            }

        }
        if($request->get('pagesIds') !=null && $request->get('pagesIds')!="")
        {
            $this->bannerPages->deleteBannerPages($bannerId);
            $this->saveBannerPages($bannerId,$request->get('pagesIds'));
        }
        return redirect('maliksajidawan786@gmail.com/banners/listing');
    }
    public function addBanner(AddBannerRequest $request)
    {
        $bannerId = $this->saveBanner($request);
        if($request->get('societiesIds')[0] !=null && $request->get('societiesIds')[0] != "")
        {
            $this->saveBannerSocieties($request->get('societiesIds'),$bannerId);
        }
        if($request->get('area')[0] !=null && $request->get('area')[0] != "")
        {
            $this->saveBannerSizes($bannerId,$request->get('area'),$request->get('unit'));
        }
        if($request->get('pagesIds')[0] !=null && $request->get('pagesIds')[0] !="")
        {
            $this->saveBannerPages($bannerId,$request->get('pagesIds'));
        }
        return redirect('maliksajidawan786@gmail.com/banners/listing');
    }

    public function saveBanner(AddBannerRequest $request)
    {
       return $this->bannersRepo->saveBanner($request->getBannerModel());
    }
    public function saveBannerSocieties(array $societies,$bannerId)
    {
        return $this->bannersRepo->saveSocieties( $societies,$bannerId);
    }
    public function saveBannerSizes($bannerId,$area,$unit)
    {
        return $this->bannersRepo->saveBannerSizes($bannerId,$area,$unit);
    }
    public function saveBannerPages($bannerId,$pageIds)
    {
        return $this->bannersRepo->saveBannerPages($bannerId,$pageIds);
    }
    public function updateBannerSocieties($societiesIds,$bannerId)
    {

    }
}
