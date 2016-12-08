<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/8/2016
 * Time: 10:23 AM
 */

namespace App\Http\Requests\Requests\Society;
use App\DB\Providers\SQL\Models\Society;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\SocietyValidators\UpdateSocietyValidator;
use App\Transformers\Request\Society\UpdateSocietyTransformer;
class UpdateSocietyRequest extends Request implements RequestInterface
{
    public $validator;
    public function __construct()
    {
        parent::__construct(new UpdateSocietyTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateSocietyValidator($this);
    }
    public function authorize()
    {

    }
    public function validate()
    {
        return $this->validator->validate();
    }
    public function getSocietyModel()
    {
        $society = new Society();
        $society->id = $this->get('id');
        $society->name = $this->get('society');
        $society->cityId = $this->get('cityId');
        $society->priority = $this->get('priority');
        return $society;
    }
}