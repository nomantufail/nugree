<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\BannerValidators;
use Illuminate\Support\Facades\Validator;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class AddBannerValidator extends BannersValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'bannerImage'=>'required|banner_size_validation',
            'pagesIds'=>'required',
            'position'=>'required',
            'type'=>'required',
            'priority'=>'required',

        ];
    }

    public function registerDashboardImageSizeRule()
    {
        Validator::extend('banner_size_validation', function($attribute, $value, $parameters)
        {
            $file = $this->request->get('bannerImage');
                $fileName = $file->getClientOriginalExtension();
                $image_size = $file->getClientSize();
        if((strtolower($fileName) != 'jpg' && strtolower($fileName) != 'jpeg' && strtolower($fileName) !='png' && strtolower($fileName) !='gif') || ($image_size<=1024))
                {
                    return false;
                }

            return true;
        });
    }

}

