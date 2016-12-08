<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\FeatureSection;

use App\DB\Providers\SQL\Models\FeatureSection;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\FeatureSectionValidators\UpdateFeatureSectionValidator;
use App\Transformers\Request\FeatureSection\UpdateFeatureSectionTransformer;

class UpdateFeatureSectionRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdateFeatureSectionTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateFeatureSectionValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return FeatureSection::class
     * */
    public function getFeatureSectionModel()
    {
        $featureSection = new FeatureSection();
        $featureSection->id = $this->get('id');
        $featureSection->name = $this->get('section');
        $featureSection->priority = $this->get('priority');
        return $featureSection;
    }

} 