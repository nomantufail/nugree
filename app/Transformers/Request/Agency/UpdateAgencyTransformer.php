<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Agency;


use App\Transformers\Request\RequestTransformer;


class UpdateAgencyTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id'=>$this->request->input('agency_id'),
            'userId'=>$this->request->input('user_id'),
            'agencyName' => $this->request->input('agency_name'),
            'description'=>$this->request->input('description'),
            'companyMobile' => $this->request->input('mobile'),
            'companyPhone'=>$this->request->input('phone'),
            'companyAddress' => $this->request->input('address'),
            'companyEmail'=>$this->request->input('email'),
            'companyLogo' => $this->request->input('logo'),

        ];
    }
}