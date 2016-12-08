<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Location;



use App\DB\Providers\SQL\Models\Location;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LocationValidators\AddLocationValidator;
use App\Http\Validators\Validators\LocationValidators\DeleteLocationValidator;
use App\Http\Validators\Validators\LocationValidators\UpdateLocationValidator;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Transformers\Request\Location\AddLocationTransformer;
use App\Transformers\Request\Location\DeleteLocationTransformer;
use App\Transformers\Request\Location\UpdateLocationTransformer;

class DeleteLocationRequest extends Request implements RequestInterface{

    public $validator = null;
    public $location ="";
    public function __construct(){
        parent::__construct(new DeleteLocationTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteLocationValidator($this);
        $this->location = (new LocationsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }


    /**
     * @return Location|null
     */
    public function getLocationModel()
    {
        return $this->location->getById($this->get('id'));
    }

} 