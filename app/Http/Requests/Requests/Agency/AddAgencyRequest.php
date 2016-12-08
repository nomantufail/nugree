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
use App\Http\Validators\Validators\AgencyValidators\AddAgencyValidator;
use App\Transformers\Request\Agency\AddAgencyTransformer;
class AddAgencyRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddAgencyTransformer($this->getOriginalRequest()));
        $this->validator = new AddAgencyValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return Agency::class
     * */
    public function getAgencyModel()
    {
        $agency= new Agency();
        $agency->userId= $this->get('userId');
        $agency->name= $this->get('agencyName');
        $agency->description= $this->get('description');
        $agency->mobile= $this->get('companyMobile');
        $agency->phone= $this->get('companyPhone');
        $agency->address= $this->get('companyAddress');
        $agency->email= $this->get('companyEmail');
        $agency->logo= $this->get('companyLogo');
        return $agency;
    }

} 