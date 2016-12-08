<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 10:50 AM
 */

namespace App\Http\Requests\Requests\PropertyDocument;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Transformers\Request\PropertyDocument\GetPropertyDocumentsTransformer;

class GetAllPropertyDocumentsRequest extends Request implements RequestInterface
{
    public function __construct()
    {
        parent::__construct(new GetPropertyDocumentsTransformer($this->getOriginalRequest()));
    }
    public function authorize(){}

    public function validate(){}
}