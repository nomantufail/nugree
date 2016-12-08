<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */
namespace App\Http\Requests\Requests\JoinUs;
use App\DB\Providers\SQL\Models\JoinUs;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\JoinUsValidators\AddJoinUsValidator;
use App\Transformers\Request\JoinUs\AddJoinUsTransformer;

class AddJoinUsRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddJoinUsTransformer($this->getOriginalRequest()));
        $this->validator = new AddJoinUsValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate()
    {
        return $this->validator->validate();
    }

    public function getUserJoinUsRequirementModel()
    {
        $userJoinUsRequirement= new JoinUs();
        $userJoinUsRequirement->name= $this->get('name');
        $userJoinUsRequirement->email= $this->get('email');
        $userJoinUsRequirement->phone= $this->get('phone');
        $userJoinUsRequirement->address= $this->get('address');
        $userJoinUsRequirement->message= $this->get('message');
        $userJoinUsRequirement->purpose= $this->get('purpose');
        return $userJoinUsRequirement;
    }

} 