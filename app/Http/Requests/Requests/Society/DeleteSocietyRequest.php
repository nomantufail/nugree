<?php
/**
 * Created by WAQAS
 * User: waqas
 * Date: 4/8/2016
 * Time: 11:26 AM
 */

namespace App\Http\Requests\Requests\Society;


use App\DB\Providers\SQL\Models\Society;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;


use App\Http\Validators\Validators\SocietyValidators\DeleteSocietyValidator;
use App\Transformers\Request\Society\DeleteSocietyTransformer;
class DeleteSocietyRequest extends Request implements RequestInterface
{
    public $validator = null;
    public function __construct(){
        parent::__construct(new DeleteSocietyTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteSocietyValidator($this);
    }
    public function authorize()
    {}
    public function validate(){
        return $this->validator->validate();
    }
    public function getSocietyModel()
    {
        $society = new Society();
        $society->id = $this->get('id');
        return $society;
    }

}