<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 11:07 AM
 */

namespace App\Repositories\Transformers\Sql;

use App\Objects\Agency;
use App\Objects\Country;
use App\Objects\MembershipPlan;
use App\Objects\User;
use App\Repositories\Interfaces\Transformers\RepositoryTransformerInterface;

class UserTransformer extends SqlTransformer implements RepositoryTransformerInterface
{

    public function transform($originalUser)
    {
        if($originalUser == null){return null;}

        $user = new User();
        $user->id = $originalUser->id;
        $user->fName = $originalUser->f_name;
        $user->lName = $originalUser->l_name;
        $user->phone = $originalUser->phone;
        $user->address = $originalUser->address;
        $user->fax = $originalUser->fax;
        $user->mobile = $originalUser->mobile;
        $user->zipCode = $originalUser->zipcode;
        $user->email = $originalUser->email;
        $user->password = $originalUser->password;
        $user->access_token = $originalUser->access_token;
        $user->notificationSettings = $originalUser->notification_settings;
        $user->membershipStatus = $originalUser->membershipStatus;
        $user->country = $this->transformCountry($originalUser->country);
        $user->membershipPlan = $this->transformMembershipPlan($originalUser->membershipPlan);
        $user->agencies = $this->transformAgencies($originalUser->agencies->toArray());
        $user->createdAt = $originalUser->created_at;
        $user->updatedAt = $originalUser->updated_at;


        return $user;
    }

    public function transformCountry(\App\Models\Sql\Country $originalCountry)
    {
        $country = new Country();
        $country->id = $originalCountry->id;
        $country->name = $originalCountry->name;
        $country->createdAt = $originalCountry->created_at;
        $country->updatedAt = $originalCountry->updated_at;

        return $country;
    }

    public function transformMembershipPlan(\App\Models\Sql\MembershipPlan $plan)
    {
        $membershipPlan = new MembershipPlan();
        $membershipPlan->id = $plan->id;
        $membershipPlan->name = $plan->name;
        $membershipPlan->description = $plan->description;
        $membershipPlan->hot = $plan->hot;
        $membershipPlan->featured = $plan->featured;
        $membershipPlan->createdAt = $plan->created_at;
        $membershipPlan->updatedAt = $plan->updated_at;

        return $membershipPlan;
    }

    public function transformAgency(\App\Models\Sql\Agency $originalAgency)
    {
        $agency = new Agency();
        $agency->id = $originalAgency->id;
        $agency->phone = $originalAgency->phone;
        $agency->address = $originalAgency->address;
        $agency->name = $originalAgency->name;
        $agency->mobile = $originalAgency->mobile;
        $agency->email = $originalAgency->email;
        $agency->createdAt = $originalAgency->created_at;
        $agency->updatedAt = $originalAgency->updated_at;

        return $agency;
    }

    public function transformAgencies(array $agencies)
    {
        return array_map([$this, 'transformAgency'], $agencies);
    }
}