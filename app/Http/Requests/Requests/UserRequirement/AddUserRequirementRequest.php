<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */
namespace App\Http\Requests\Requests\UserRequirement;
use App\DB\Providers\SQL\Models\UserRequirement;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\UserRequirementValidators\AddUserRequirementValidator;
use App\Transformers\Request\UserRequirement\AddUserRequirementTransformer;

class AddUserRequirementRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddUserRequirementTransformer($this->getOriginalRequest()));
        $this->validator = new AddUserRequirementValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate()
    {
        return $this->validator->validate();
    }

    public function getUserRequirementModel()
    {
        $userRequirement= new UserRequirement();
        $userRequirement->name= $this->get('name');
        $userRequirement->email= $this->get('email');
        $userRequirement->phone= $this->get('phone');
        $userRequirement->subject= $this->get('subject');
        $userRequirement->requirement= $this->get('requirement');
        return $userRequirement;
    }

} 