<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/7/2016
 * Time: 10:43 AM
 */

namespace App\Http\Requests\Requests\Location;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LocationValidators\GetLocationsByCityValidator;
use App\Http\Validators\Validators\LocationValidators\SearchLocationValidator;
use App\Transformers\Request\Location\GetLocationsByCityTransformer;
use App\Transformers\Request\Location\SearchLocationTransformer;

class SearchLocationRequest extends Request implements RequestInterface
{
    public $validator;
    public function __construct()
    {
        parent::__construct(new SearchLocationTransformer($this->getOriginalRequest()));
        $this->validator = new SearchLocationValidator($this);
    }
    public function authorize()
    {

    }
    public function validate()
    {
        return $this->validator->validate();
    }


}