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

class AddUserSearchesValidator extends UserValidator implements ValidatorsInterface
{

    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'email' => 'required',
        ];
    }
}