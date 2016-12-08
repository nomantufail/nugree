<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyStatus;

use App\DB\Providers\SQL\Models\PropertyStatus;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyStatusValidators\UpdatePropertyStatusValidator;
use App\Transformers\Request\PropertyStatus\UpdatePropertyStatusTransformer;

class UpdatePropertyStatusRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdatePropertyStatusTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertyStatusValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return PropertyStatus::class
     * */
    public function getPropertyStatusModel()
    {
        $propertyStatus = new PropertyStatus();
        $propertyStatus->id = $this->get('id');
        $propertyStatus->name = $this->get('propertyStatus');
        return $propertyStatus;
    }

} 