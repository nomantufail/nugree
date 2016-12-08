<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdateUserValidator extends UserValidator implements ValidatorsInterface
{
    private $roles;
    private $idForAgentBroker = 3;
    public function __construct($request){
        parent::__construct($request);
        $this->request = $request;
        $this->roles = (new RolesRepoProvider())->repo();
    }
    public function CustomValidationMessages(){
        $termsConditionsMessage ='Dear user you must agree our terms and conditions';
        return [
            'required.required' => ':attribute is required',
            'fName.required' => 'First name is required',
            'lName.required' => 'Last name is required',
            'password.match_existing_password' => 'Password did not match with your existing password.',
            'phone.required' => 'Phone is required',
            'societies.locations_limit'=>'you can not select more then 3 locations',
            'userRoles.required' => 'User roles is required',
            'userRoles.cannot_remove_agent' => 'Dear user! once you are an agent, you cannot remove this role.',
            'termsConditions.required' => $termsConditionsMessage,
            'termsConditions.equals' => $termsConditionsMessage,
            /* Agency messages */
            'agencyName.required' => 'Agency name is required',
            'companyAddress.required' => 'Company address is required',
            'companyEmail.required' => 'Company email is required',
            'companyLogo.max_image_size' => 'Company Logo should be less then or equal to 1000 X 1000 px'
        ];
    }

    public function userRules()
    {
        return [
            'userId' =>'required',
            'fName'  =>'required|min:3|max:55',
            'lName'  =>'required|min:3|max:55',
            'email'  =>'required|email|unique:users,email,'.$this->request->get('userId').'|max:255',
            'password' =>'required|match_existing_password',
            'phone' =>'required|min:3|max:15',
            'userRoles' =>'required|cannot_remove_agent',
        ];
    }

    public function agencyRules()
    {
        $rules = [
            'agencyName' => 'required|max:255',
            'companyAddress' => 'required|max:225',
            'locations' => 'required|locations_limit',
            'companyEmail' => 'required|email|max:255',
            'agencyDescription'=>'max:1200',
            'companyLogo'=>'image_validation|max_image_size:1000,1000'
        ];

        if((new UsersRepoProvider())->repo()->userWasAgent($this->request->get('userId')))
            $rules['agencyId'] = 'required';

        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ($this->request->userIsAgent())?array_merge($this->userRules(),$this->agencyRules()):$this->userRules();
    }

    public function registerMatchExistingPasswordRule()
    {
        Validator::extend('match_existing_password', function($attribute, $value, $parameters)
        {
            $users = (new UsersRepoProvider())->repo();
            try{
                $user = $users->getById($this->request->get('userId'));
                if(!Hash::check($this->request->get('password'), $user->password))
                    return false;
            }catch (\Exception $e){
                return false;
            }

            return true;
        });
    }

    public function registerCannotRemoveAgentRule()
    {
        Validator::extend('cannot_remove_agent', function($attribute, $value, $parameters)
        {
            $userRoles = $this->roles->getUserRoles($this->request->get('userId'));
            $userRolesIds = Helper::propertyToArray($userRoles, 'id');
            if(in_array($this->idForAgentBroker, $userRolesIds))
            {
                $currentRoles = $this->request->get('userRoles');
                if(!in_array($this->idForAgentBroker,$currentRoles)){
                    return false;
                }
            }
            return true;
        });
    }

    public function registerSocietiesLimitRule()
    {
        Validator::extend('locations_limit', function($attribute, $value, $parameters)
        {
            try {
                $locations = $this->request->get('locations');
                $societiesLimit = false;
                if (sizeof($locations) < 4 && sizeof($locations) > 0) {
                    $societiesLimit = true;
                }
                if(!$societiesLimit){
                    return false;
                }
            }catch(\Exception $e)
            {
                throw $e;
            }
            return true;
        });
    }
}