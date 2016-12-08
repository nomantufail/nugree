<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use Illuminate\Support\Facades\Validator;

class TrustedAgentValidator extends UserValidator implements ValidatorsInterface
{
    private $userJsonRepo = "";
    public function __construct($request){
        parent::__construct($request);
        $this->userJsonRepo = (new UsersJsonRepoProvider())->repo();
    }
    public function CustomValidationMessages(){
        return [
            'userId.agent_exists' => 'Sorry agent not found!'
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
           'userId'=>'required|agent_exists'
        ];
    }

    public function registerAgentExistsRule()
    {
        Validator::extend('agent_exists', function($attribute, $value, $parameters)
        {
            try{
                $agent = $this->userJsonRepo->find($this->request->get('userId'));
                $isAgent = false;
                foreach($agent->roles as $agentRole)
                {
                    if($agentRole->id == 3)
                    {
                        $isAgent = true;
                    }
                }

                if( !$isAgent)
                    return false;

            }catch (\Exception $e){
                return false;
            }

            return true;
        });
    }
}