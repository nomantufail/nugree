<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Agency;


use App\DB\Providers\SQL\Models\Agency;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AgencyValidators\DeleteAgencyStaffValidator;
use App\Http\Validators\Validators\AgencyValidators\DeleteAgencyValidator;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use App\Transformers\Request\Agency\DeleteAgencyStaffTransformer;
use App\Transformers\Request\Agency\DeleteAgencyTransformer;

class DeleteAgencyStaffRequest extends Request implements RequestInterface{

    public $validator = null;
    public $users = null;
    public function __construct(){
        parent::__construct(new DeleteAgencyStaffTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteAgencyStaffValidator($this);
        $this->users = (new  UsersRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getAgencyStaffModel()
    {
        return $this->users->getById($this->get('id'));
    }

} 