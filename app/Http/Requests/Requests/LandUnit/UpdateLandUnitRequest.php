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
use App\Http\Validators\Validators\LandUnitValidators\UpdateLandUnitValidator;
use App\Transformers\Request\LandUnit\UpdateLandUnitTransformer;

class UpdateLandUnitRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdateLandUnitTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateLandUnitValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return LandUnit::class
     * */
    public function getLandUnitModel()
    {
        $landUnit = new LandUnit();
        $landUnit->id = $this->get('id');
        $landUnit->name = $this->get('landUnit');
        return $landUnit;
    }
}