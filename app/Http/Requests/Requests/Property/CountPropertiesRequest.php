<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Factories\Factories\User\UserFactory;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyValidators\CountPropertiesValidator;
use App\Transformers\Request\Property\CountPropertiesTransformer;

class CountPropertiesRequest extends Request implements RequestInterface{

    public $validator = null;
    public $user = "";
    public function __construct(){
        parent::__construct(new CountPropertiesTransformer($this->getOriginalRequest()));
        $this->validator = new CountPropertiesValidator($this);
        $this->user = new UserFactory();
    }
    public function getUserModel()
    {
        return $this->user->find($this->get('userId'));
    }

    public function authorize()
    {
        return true;
    }

    public function validate()
    {
        return $this->validator->validate();
    }
} 