<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\Auth;


use App\Transformers\Request\RequestTransformer;

class RegisterUserTransformer extends RequestTransformer{

    public function transform(){
        return array_merge($this->transformUserInfo(), $this->transformAgencyInfo());
    }

    public function transformUserInfo()
    {
         return [
            'fName'=>$this->request->input('fName'),
            'lName'=>$this->request->input('lName'),
            'email'=>$this->request->input('email'),
            'password'=>$this->request->input('password'),
            'passwordAgain'=>$this->request->input('passwordAgain'),
            'phone'=>$this->request->input('phone'),
            'mobile'=>$this->request->input('mobile'),
            'address'=>$this->request->input('address'),
            'zipCode'=>$this->request->input('zipCode'),
            'userRoles'=>$this->request->input('userRoles'),
            'isAgent'=>$this->request->input('isAgent'),
            'securityCode'=>$this->request->input('securityCode'),
            'termsConditions'=>$this->request->input('termsConditions'),
            'wantNotifications'=>$this->request->input('wantNotifications'),
        ];
    }

    public function transformAgencyInfo()
    {
        return [
            'agencyName' => $this->request->input('agencyName'),
            'agencyDescription' => $this->request->input('agencyDescription'),
            'locations'=>$this->request->input('locations'),
            'companyPhone' => $this->request->input('companyPhone'),
            'companyMobile' => $this->request->input('companyMobile'),
            'companyAddress' => $this->request->input('companyAddress'),
            'companyEmail' => $this->request->input('companyEmail'),
            'companyLogo' => $this->request->file('companyLogo'),
        ];
    }
} 