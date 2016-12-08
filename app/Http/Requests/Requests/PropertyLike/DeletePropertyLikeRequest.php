<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\PropertyLike;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyLikeValidators\DeletePropertyLikeValidator;
use App\Repositories\Providers\Providers\PropertyLikesRepoProvider;
use App\Repositories\Repositories\Sql\PropertyLikeRepository;
use App\Transformers\Request\PropertyLike\DeletePropertyLikeTransformer;

class DeletePropertyLikeRequest extends Request implements RequestInterface{

    public $validator = null;
    private $propertyLike = null;
    public function __construct(){
        parent::__construct(new DeletePropertyLikeTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertyLikeValidator($this);
        $this->propertyLike= (new PropertyLikesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getPropertyLikeModel()
    {
        return $this->propertyLike->getById($this->get('id'));
    }

} 