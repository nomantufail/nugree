<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 9:39 AM
 */

namespace App\Http\Requests\Requests\Feature;

use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\FeatureValidators\DeleteFeatureValidator;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Transformers\Request\Feature\DeleteFeatureTransformer;

class DeleteFeatureRequest extends Request implements RequestInterface
{
    public $validator = null;
    public $features = null;
    public function __construct()
    {
        parent::__construct(new DeleteFeatureTransformer($this->getOriginalRequest()));
         $this->validator = new DeleteFeatureValidator($this);
        $this->features = (new FeaturesRepoProvider())->repo();
    }
    public function authorize(){}
    public function validate()
    {
        return $this->validator->validate();
    }
    public function GetFeatureModel()
    {
        return $this->features->getById($this->get('featureId'));
    }
}