<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\LandUnit;



use App\DB\Providers\SQL\Models\LandUnit;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LandUnitValidators\AddLandUnitValidator;
use App\Transformers\Request\LandUnit\AddLandUnitTransformer;

class AddLandUnitRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddLandUnitTransformer($this->getOriginalRequest()));
        $this->validator = new AddLandUnitValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return landUnit::class
     * */
    public function getLandUnitModel()
    {
        $landUnit = new LandUnit();
        $landUnit->name = $this->get('landUnit');
        return $landUnit;
    }

} 