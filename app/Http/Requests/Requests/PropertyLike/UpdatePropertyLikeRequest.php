<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyLike;

use App\DB\Providers\SQL\Models\PropertyLike;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyLikeValidators\UpdatePropertyLikeValidator;
use App\Transformers\Request\PropertyLike\UpdatePropertyLikeTransformer;

class UpdatePropertyLikeRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdatePropertyLikeTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertyLikeValidator($this);
    }
    public function authorize(){
        return true;
    }
    public function validate(){
        return $this->validator->validate();
    }
    /**
     * @return PropertyLike::class
     * */
    public function getPropertyLikeModel()
    {
        $propertyLike = new PropertyLike();
        $propertyLike->userId = $this->get('userId');
        $propertyLike->propertyId = $this->get('propertyId');
        return $propertyLike;
    }

} 