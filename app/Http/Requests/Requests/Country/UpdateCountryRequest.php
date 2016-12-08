<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 9:15 AM
 */

namespace App\Http\Requests\Requests\Country;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;

use App\Http\Validators\Validators\CountryValidators\UpdateCountryValidator;
use App\Transformers\Request\Country\UpdateCountryTransformer;
use App\DB\Providers\SQL\Models\Country;
class UpdateCountryRequest extends Request implements RequestInterface
{
    public $validator =null;
    public function __construct()
    {
        parent::__construct(new UpdateCountryTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateCountryValidator($this);
    }
    public function authorize()
    {

    }

    public function validate()
    {
        return $this->validator->validate();
    }
    public function getCountryModel()
    {
        $country = new Country();
        $country->id   = $this->get('id');
        $country->name = $this->get('country');
        return $country;
    }
}