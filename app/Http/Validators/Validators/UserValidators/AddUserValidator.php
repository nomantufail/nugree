<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Requests\Requests\Auth\RegistrationRequest;
use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AddUserValidator extends UserValidator implements ValidatorsInterface
{

    /**
     * @param RegistrationRequest $request
     */
    public function __construct(RegistrationRequest $request){
        parent::__construct($request);
        $this->request = $request;
    }
    public function CustomValidationMessages(){

        $termsConditionsMessage ='Dear user you must agree our terms and conditions';
        return [
            'required.required' => ':attribute is required',
            'fName.required' => 'First name is required',
            'fName.min' => 'First name must be atleast 3 chars',
            'fName.max' => 'First name must be less then 56 chars',
            'lName.required' => 'Last name is required',
            'lName.min' => 'Last name must be atleast 3 chars',
            'lName.max' => 'Last name must be less then 56 chars',
            'passwordAgain.required' => 'Password Again is required',
            'passwordAgain.conform_password' => 'Your password is not matching',
            'mobile.required' => 'Mobile is required',
            'userRoles.required' => 'please select atleast one role',
            'termsConditions.required' => $termsConditionsMessage,
            'termsConditions.equals' => $termsConditionsMessage,
            /* Agency messages */
            'agencyName.required' => 'Agency name is required',
            'agencyName.unique_agent_in_societies' => ':conflictedSocieties',
            'companyAddress.required' => 'Company address is required',
            //'societies.required' => 'Please Select atleast 1 society',
            'societies.societies_limit' => 'You can select only 3 Societies.',
            'companyEmail.required' => 'Company email is required',
            'companyLogo.max_image_size' => 'Company Logo should be less then or equal to 1000 X 1000 px',
            'companyLogo.image_validation' => 'invalid Company Logo'
        ];
    }

    public function userRules()
    {
        return [
            'fName' => 'required|min:3|max:55',
            'lName' => 'required|min:3|max:55',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:5|max:15',
            'passwordAgain' => 'required|conform_password|min:5|max:15',
            'mobile' => 'required|min:5|max:15',
            'userRoles' => 'required',
            'termsConditions' => 'required|equals:1'
        ];
    }

    public function agencyRules()
    {
        return [
            'agencyName' => 'required|max:255',
            'companyAddress' => 'required|max:225',
            'locations' => 'required|locations_limit',
            'companyEmail' => 'required|email|unique:agencies,email|max:255',
            'agencyDescription'=>'max:1200',
            'companyLogo'=>'image_validation|max_image_size:1000,1000'
        ];
    }



    public function registerSocietiesInDealRule()
    {
        Validator::extend('unique_agent_in_societies', function($attribute, $value, $parameters)
        {
            $societies = $this->request->get('societies');
            $societies = ($societies == null)?[]: $societies;
            $finalRecord = [];
            $existingSocieties = (new SocietiesRepoProvider())->repo()->getSocietiesYouDealIn($this->request->get('agencyName'));
            foreach ($societies as $key => $val) {
                foreach ($existingSocieties as $society) {
                    if ($val == $society->id) {
                        $finalRecord[] = $society;
                    }
                }
            }
        });
    }

    public function registerSocietiesLimitRule()
    {
        Validator::extend('locations_limit', function($attribute, $value, $parameters)
        {
            try {
                $societies = explode(',', $this->request->get('locations'));
                $societiesLimit = false;
                if (sizeof($societies) < 4 && sizeof($societies) > 0) {
                    $societiesLimit = true;
                }
                if(!$societiesLimit){
                    return false;
                }
            }catch(\Exception $e)
            {
                return false;
            }
            return true;
        });
    }
    public function registerConformPasswordRule()
    {
        Validator::extend('conform_password', function($attribute, $value, $parameters)
        {
            try {
                $conformPassword = false;
                $password = $this->request->get('password');
                $againPassword = $this->request->get('passwordAgain');
                if ($password == $againPassword) {
                    $conformPassword = true;
                }
                if(!$conformPassword){
                    return false;
                }
            }
            catch(\Exception $e)
            {
                return false;
            }
            return true;
        });
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
}