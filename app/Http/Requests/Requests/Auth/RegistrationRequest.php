<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Auth;


use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\AgencyLocation;
use App\DB\Providers\SQL\Models\AgencySociety;
use App\DB\Providers\SQL\Models\User;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\AddUserValidator;
use App\Transformers\Request\Auth\RegisterUserTransformer;

class RegistrationRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){

        parent::__construct(new RegisterUserTransformer($this->getOriginalRequest()));
        $this->validator = new AddUserValidator($this);
    }
    public function authorize(){
        return true;
    }
    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return User::class
     * */
    public function getUserModel()
    {
        $user = new User();
        $user->fName = $this->get('fName');
        $user->lName = $this->get('lName');
        $user->email = $this->get('email');
        $user->password = bcrypt($this->get('password'));
        $user->phone = $this->get('phone');
        $user->mobile = $this->get('mobile');
        $user->address = $this->get('address');
        $user->zipCode = $this->get('zipCode');
        $user->trustedAgent = 0; /* its temporary. */
        $user->countryId = 1;
        $user->membershipPlanId = 1;
        $user->notificationSettings = ($this->get('wantNotifications') == null)?0:$this->get('wantNotifications');
        return $user;
    }

    public function getAgencyModel()
    {
        $agency = new Agency();
        $agency->name = $this->get('agencyName');
        $agency->description = $this->get('agencyDescription');
        $agency->phone = $this->get('companyPhone');
        $agency->mobile = $this->get('companyMobile');
        $agency->email = $this->get('companyEmail');
        $agency->address = $this->get('companyAddress');
        $agency->slug = preg_replace('/\s+/', '-',$this->get('agencyName'));
        return $agency;
    }

    public function file($file)
    {
        return $this->get($file);
    }

    public function getCompanyLogo()
    {
        return $this->file('companyLogo');
    }

    public function hasCompanyLogo()
    {
        return $this->has('companyLogo');
    }

    public function getAgencyCities()
    {
        return [1]; //we just deal in lahore
    }
//    public function getAgencySocieties($agencyId)
//    {
//        $societiesIds = $this->get('societies');
//        $agencySocieties = [];
//        foreach ($societiesIds as $societyId) {
//            $agencySociety = new AgencySociety();
//            $agencySociety->agencyId = $agencyId;
//            $agencySociety->societyId = $societyId;
//            $agencySocieties[] =$agencySociety;
//        }
//        return $agencySocieties;
//    }
    public function getAgencyLocations($agencyId)
    {
        $locationIds = explode(',',$this->get('locations'));
        $agencyLocations = [];
        foreach ($locationIds as $locationId)
        {
            $agencyLocation = new AgencyLocation();
            $agencyLocation->agencyId = $agencyId;
            $agencyLocation->locationId = $locationId;
            $agencyLocations[] =$agencyLocation;
        }
        return $agencyLocations;
    }
    public function getUserRoles()
    {
        return (is_array($this->get('userRoles')))?$this->get('userRoles'):[1];
    }
    public function userIsAgent()
    {
        if(is_array($this->get('userRoles')))
            return (in_array(3,$this->get('userRoles')))?true:false;
        else
            return false;
    }


}