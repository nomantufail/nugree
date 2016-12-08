<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Agency;


use App\Transformers\Request\RequestTransformer;


class AddAgencyStaffTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'firstName'=> $this->request->input('first_name'),
            'lastName'=> $this->request->input('last_name'),
            'email'=> $this->request->input('email'),
            'mobile'=> $this->request->input('mobile'),
            'phone'=> $this->request->input('phone'),
            'address'=> $this->request->input('address'),
            'password'=> $this->request->input('password'),
            'countryId'=> $this->request->input('country_id'),
            'membershipPlanId'=> $this->request->input('membership_plan_id'),
         ];
    }
}