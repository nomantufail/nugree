<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/7/2016
 * Time: 10:43 AM
 */

namespace App\Http\Requests\Requests\Society;
use App\DB\Providers\SQL\Models\Society;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\SocietyValidators\AddSocietyValidator;
use App\Http\Validators\Validators\SocietyValidators\GetSocietiesByCityValidator;
use App\Transformers\Request\Society\AddSocietyTransformer;
use App\Transformers\Request\Society\GetSocietiesByCityTransformer;

class GetSocietiesByCityRequest extends Request implements RequestInterface
{
    public $validator;
    public function __construct()
    {
        parent::__construct(new GetSocietiesByCityTransformer($this->getOriginalRequest()));
        $this->validator = new GetSocietiesByCityValidator($this);
    }
    public function authorize()
    {

    }
    public function validate()
    {
        return $this->validator->validate();
    }


}