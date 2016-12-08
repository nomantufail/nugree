<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Agency;


use App\DB\Providers\SQL\Models\Agency;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AgencyValidators\DeleteAgencyValidator;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Repositories\Sql\AgenciesRepository;
use App\Transformers\Request\Agency\DeleteAgencyTransformer;

class DeleteAgencyRequest extends Request implements RequestInterface{

    public $validator = null;
    private $agencies = null;
    public function __construct(){
        parent::__construct(new DeleteAgencyTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteAgencyValidator($this);
        $this->agencies = (new AgenciesRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getAgencyModel()
    {
        return $this->agencies->getById($this->get('id'));
    }

} 