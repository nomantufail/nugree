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
use App\Transformers\Request\Society\AddSocietyTransformer;

class AddSocietyRequest extends Request implements RequestInterface
{
    public $validator;
    public function __construct()
    {
        parent::__construct(new AddSocietyTransformer($this->getOriginalRequest()));
        $this->validator = new AddSocietyValidator($this);
    }
    public function authorize()
    {}
    public function validate()
    {
        return $this->validator->validate();
    }
    public function getSocietyModel()
    {
        $society = new Society();
        $society->name = $this->get('society');
        $society->cityId = $this->get('cityId');
        $society->priority = $this->get('priority');
        return $society;
    }

}