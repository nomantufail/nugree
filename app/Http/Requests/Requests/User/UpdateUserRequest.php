<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\AgencyLocation;
use App\DB\Providers\SQL\Models\AgencySociety;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserValidators\UpdateUserValidator;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\User\UpdateUserTransformer;

class UpdateUserRequest extends Request implements RequestInterface
{
    public $validator;
    private $users;
    private $agencies;
    public function __construct(){
        parent::__construct(new UpdateUserTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateUserValidator($this);

        $this->users = (new UsersRepoProvider())->repo();
        $this->agencies = (new AgenciesRepoProvider())->repo();
    }

    public function authorize(){

        if($this->user()->can('update','user',$this->getUserModel()))
        {
            return true;
        }
        return false;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getUserModel()
    {
        $user = $this->users->getById($this->get('userId'));
        $user->address = $this->get('address');
        $user->email = $this->get('email');
        $user->fax = $this->get('fax');
        $user->fName = $this->get('fName');
        $user->lName = $this->get('lName');
        $user->mobile = $this->get('mobile');
        $user->phone = $this->get('phone');
        $user->zipCode = $this->get('zipCode');
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

    public function getAgencyLocations($agencyId)
    {
        $locationIds = $this->get('locations');
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

    public function getAgencyCities()
    {
        return [1]; //we just deal in lahore
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