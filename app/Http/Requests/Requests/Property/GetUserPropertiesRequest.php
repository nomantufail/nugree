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
use App\Http\Validators\Validators\PropertyValidators\GetUserPropertiesValidator;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Transformers\Request\Property\GetUserPropertiesTransformer;

class GetUserPropertiesRequest extends Request implements RequestInterface{

    public $validator = null;
    private $features = null;
    public function __construct(){
        parent::__construct(new GetUserPropertiesTransformer($this->getOriginalRequest()));
        $this->validator = new GetUserPropertiesValidator($this);
        $this->features = (new FeaturesRepoProvider())->repo();
    }
    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 