<?php
/**
 * Created by Noman Tufail.
 * User: waqas
 * Date: 3/21/2016
 * Time: 9:22 AM
 */

namespace App\Http\Validators\Validators\UserValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use Illuminate\Support\Facades\Validator;

class GetAgentValidator extends UserValidator implements ValidatorsInterface
{
    private $userJsonRepo = "";
    private $agencyRepo ="";
    public function __construct($request){
        parent::__construct($request);
        $this->userJsonRepo = (new UsersJsonRepoProvider())->repo();
        $this->agencyRepo = (new AgenciesRepoProvider())->repo();
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
           'agencySlug'=>'required'
        ];
    }

    public function registerAgentExistsRule()
    {
        Validator::extend('agent_exists', function($attribute, $value, $parameters)
        {
            try{
                $agency = $this->agencyRepo->getAgencyBySlug($this->request->get('userSlug'));
                $agent = $this->userJsonRepo->find($agency->userId);
                $isAgent = false;
                foreach($agent->roles as $agentRole)
                {
                    if($agentRole->id == 3)
                    {
                        $isAgent = true;
                    }
                }

                if( $isAgent == false || $agent->trustedAgent !=1)
                    return false;

            }catch (\Exception $e){
                return false;
            }

            return true;
        });
    }

}