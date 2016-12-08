<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 9:48 AM
 */

namespace App\Transformers\Request\Feature;


use App\Transformers\Request\RequestTransformer;

class AddFeatureTransformer extends RequestTransformer
{
   public function transform()
   {
       return [
           'featureSectionId'=>$this->request->input('feature_section_id'),
           'featureName'=>$this->request->input('feature_name'),
           'featureInputName'=>$this->request->input('feature_input_name'),
           'featureHtmlStructureId'=>$this->request->input('feature_html_structure_id'),
           'featurePossibleValues'=>$this->request->input('feature_possible_values'),
           'featurePriority'=>$this->request->input('feature_priority'),
       ];
   }
}