<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */
namespace App\Http\Requests\Requests\Agency;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AgencyValidators\AddAgencyStaffValidator;
use App\DB\Providers\SQL\Models\User;
use App\Transformers\Request\Agency\AddAgencyStaffTransformer;

class AddAgencyStaffRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct()
    {
        parent::__construct(new AddAgencyStaffTransformer($this->getOriginalRequest()));
        $this->validator = new AddAgencyStaffValidator($this);
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
    public function getAgencyStaffModel()
    {
        $user= new User();
        $user->fName = $this->get('firstName');
        $user->lName = $this->get('lastName');
        $user->email = $this->get('email');
        $user->mobile = $this->get('mobile');
        $user->phone = $this->get('phone');
        $user->address = $this->get('address');
        $user->password = bcrypt($this->get('password'));
        $user->countryId = $this->get('countryId');
        $user->membershipPlanId = $this->get('membershipPlanId');
        return $user;
    }

} 