<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 10:50 AM
 */

namespace App\Http\Requests\Requests\Country;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Transformers\Request\Country\GetCountriesTransformer;

class GetAllCountriesRequest extends Request implements RequestInterface
{
    public function __construct()
    {
        parent::__construct(new GetCountriesTransformer($this->getOriginalRequest()));
    }
    public function authorize(){}

    public function validate(){}
}