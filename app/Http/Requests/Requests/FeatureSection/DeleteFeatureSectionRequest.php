<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\FeatureSection;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\FeatureSectionValidators\DeleteFeatureSectionValidator;
use App\Repositories\Providers\Providers\FeatureSectionsRepoProvider;
use App\Repositories\Repositories\Sql\FeatureSectionRepository;
use App\Transformers\Request\FeatureSection\DeleteFeatureSectionTransformer;

class DeleteFeatureSectionRequest extends Request implements RequestInterface{

    public $validator = null;
    private $featureSections = null;
    public function __construct(){
        parent::__construct(new DeleteFeatureSectionTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteFeatureSectionValidator($this);
        $this->featureSections = (new FeatureSectionsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getFeatureSectionModel()
    {
        return $this->featureSections->getById($this->get('id'));
    }

} 