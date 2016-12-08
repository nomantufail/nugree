<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;

use App\DB\Providers\SQL\Models\Property;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyValidators\AdvanceSearchUserPropertiesValidator;
use App\Http\Validators\Validators\PropertyValidators\SearchPropertiesValidator;
use App\Transformers\Request\Property\AdvanceSearchUserPropertiesTransformer;
use App\Transformers\Request\Property\SearchPropertiesTransformer;

class AdvanceSearchUserPropertiesRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AdvanceSearchUserPropertiesTransformer($this->getOriginalRequest()));
        $this->validator = new AdvanceSearchUserPropertiesValidator($this);
    }

    public function getParams()
    {
        return $this->all();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 