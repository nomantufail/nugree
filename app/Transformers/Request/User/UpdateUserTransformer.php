<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class UpdateUserTransformer extends RequestTransformer{

    public function transform(){
        return array_merge($this->transformUserInfo(), $this->transformAgencyInfo());
    }

    public function transformUserInfo()
    {
        return [
            'userId' => $this->request->input('userId'),
            'fName' => $this->request->input('fName'),
            'lName' => $this->request->input('lName'),
            'email' => $this->request->input('email'),
            'password' => $this->request->input('password'),
            'phone' => $this->request->input('phone'),
            'mobile' => $this->request->input('cell'),
            'address' => $this->request->input('address'),
            'zipCode' => $this->request->input('zipCode'),
            'fax' => $this->request->input('fax'),
            'userRoles' => $this->request->input('userRoles'),
            'isAgent' => $this->request->input('isAgent'),
        ];
    }

    public function transformAgencyInfo()
    {
        return [
            'agencyId' => $this->request->input('agencyId'),
            'agencyName' => $this->request->input('agencyName'),
            'agencyDescription' => $this->request->input('agencyDescription'),
            'locations' => $this->request->input('locations'),
            'companyPhone' => $this->request->input('companyPhone'),
            'companyMobile' => $this->request->input('companyMobile'),
            'companyAddress' => $this->request->input('companyAddress'),
            'companyEmail' => $this->request->input('companyEmail'),
            'companyLogo' => $this->request->file('companyLogo'),
            'companyLogoDeleted' => $this->request->input('companyLogoDeleted')
        ];
    }

} 