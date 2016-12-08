<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:18 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Validators\AppValidator;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use Illuminate\Support\Facades\Validator;

class PropertyValidator extends AppValidator
{
    protected $extraFeatures = null;
    protected $featuresRepository = null;
    public function __construct($request){
        parent::__construct($request);
        $this->featuresRepository = new FeaturesRepository();
        $this->setExtraFeatures();
    }

    protected function setExtraFeatures()
    {
        $this->extraFeatures = $this->featuresRepository->assignedFeaturesWithValidationRules($this->request->get('subTypeId'));
    }

    protected function getExtraFeatures()
    {
        return $this->extraFeatures;
    }

    public function CustomValidationMessages(){
        return [
            //
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function registerDashboardImageSizeRule()
    {
        Validator::extend('addProperty_max_image_size', function($attribute, $value, $parameters)
        {
            $files = $this->request->get('files');
            $originalFiles = [];
            foreach($files as $file)
            {
                if($file['file'] != "null"){
                    $originalFiles[] = $file['file'];
                }
            }
            foreach($originalFiles as $file)
            {
                $fileName = $file->getClientOriginalExtension();
                $image_size = getimagesize($file);
                if((strtolower($fileName) != 'jpg' && strtolower($fileName) != 'jpeg' && strtolower($fileName) !='png' && strtolower($fileName) !='gif') || ($image_size[0] >5000  || $image_size[1] >5000 ))
                {
                    return false;
                }
            }
            return true;
        });
    }
}