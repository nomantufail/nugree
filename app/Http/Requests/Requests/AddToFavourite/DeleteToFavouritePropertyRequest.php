<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\AddToFavourite;

use App\DB\Providers\SQL\Models\FavouriteProperty;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AddToFavouriteValidators\DeleteToFavouritePropertyValidator;
use App\Transformers\Request\AddToFavourite\DeleteToFavouritePropertyTransformer;

class DeleteToFavouritePropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new DeleteToFavouritePropertyTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteToFavouritePropertyValidator($this);
    }
    /**
     * @return bool
     */
    public function authorize(){
        return true;
    }
    /**
     * @return bool
     */
    public function validate(){
        return $this->validator->validate();
    }
    /**
     * @return FavouriteProperty
     */
    public function DeleteFavouriteProperty()
    {
        $addToFavourite = new FavouriteProperty();
        $user = $_SESSION['authUser'];
        $addToFavourite->userId =$user->id;
        $addToFavourite->propertyId = $this->get('propertyId');
        return $addToFavourite;
    }
} 