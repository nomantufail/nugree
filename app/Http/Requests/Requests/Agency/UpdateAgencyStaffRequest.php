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
use App\Http\Validators\Validators\AgencyValidators\UpdateAgencyStaffsValidator;
use App\DB\Providers\SQL\Models\User;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\Agency\UpdateAgencyStaffsTransformer;

class UpdateAgencyStaffRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct()
    {
        parent::__construct(new UpdateAgencyStaffsTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateAgencyStaffsValidator($this);
        $this->users = (new UsersRepoProvider())->repo();
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
        $user = $this->users->getById($this->get('userId'));
        $user->id = $this->get('userId');
        $user->fName = $this->get('firstName');
        $user->lName = $this->get('lastName');
        $user->email = $this->get('email');
        $user->mobile = $this->get('mobile');
        $user->phone = $this->get('phone');
        $user->address = $this->get('address');
        $user->password = bcrypt($this->get('password'));
        return $user;
    }

} 