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

class ChangePasswordValidator extends UserValidator implements ValidatorsInterface
{
    private $users;
    public function __construct($request){
        parent::__construct($request);
        $this->request = $request;
        $this->users = (new UsersRepoProvider())->repo();
    }
    public function CustomValidationMessages(){
        return [
            'userId.user_exists' => 'This user does not exists in the system.',
            'existingPassword.check_password_existence' => 'Incorrect password.',
            'newPassword.not_same' => ':attribute should be different from you previous password.'
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userId' => 'required|user_exists',
            'existingPassword' => 'required|check_password_existence',
            'newPassword' => 'required|min:5|max:20|not_same'
        ];
    }

    public function registerUserExistsRule()
    {
        Validator::extend('user_exists', function($attribute, $value, $parameters)
        {
            try{
                $this->users->getById($this->request->get('userId'));
                return true;
            }catch (\Exception $e){
                return false;
            }
        });
    }
    public function registerCheckPasswordExistenceRule()
    {
        Validator::extend('check_password_existence', function($attribute, $value, $parameters)
        {
            $user = $this->request->getUserModel();
            if(!Hash::check($this->request->get('existingPassword'), $user->password))
                return false;
            return true;
        });
    }
    public function registerDifferentRule()
    {
        Validator::extend('not_same', function($attribute, $newPassword, $parameters)
        {
            if($this->request->get('existingPassword') == $newPassword)
                return false;
            return true;
        });
    }
}