<?php

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Feature\Gateways;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;

class FeatureQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'property_features';
    }

    public function getBySubType($subTypeId)
    {
        $propertySubTypeAssignedFeatures = 'property_sub_type_assigned_features';
        return  DB::table($propertySubTypeAssignedFeatures)
            ->leftjoin($this->table,$propertySubTypeAssignedFeatures.'.property_feature_id','=',$this->table.'.id')
            ->select($this->table.'.*')
            ->where($propertySubTypeAssignedFeatures.'.property_sub_type_id','=',$subTypeId)
            ->get();
    }


    public function allAssigned()
    {
        $propertySubTypeAssignedFeatures = 'property_sub_type_assigned_features';
        $assignedFeatureValidations = 'assigned_feature_validations';
        $propertyFeatures = $this->table;
        $featureSections = "feature_sections";
        $htmlStructures = 'html_structures';
        $validationRules = 'validation_rules';
        $validationErrorMessages = 'validation_error_messages';
        $appMessages = 'app_messages';
        return  DB::table($propertySubTypeAssignedFeatures)
            ->leftjoin($propertyFeatures,$propertySubTypeAssignedFeatures.'.property_feature_id','=',$propertyFeatures.'.id')
            ->leftjoin($featureSections,$propertyFeatures.'.feature_section_id','=',$featureSections.'.id')
            ->leftjoin($htmlStructures,$propertyFeatures.'.html_structure_id','=',$htmlStructures.'.id')
            ->leftjoin($assignedFeatureValidations,$propertySubTypeAssignedFeatures.'.id','=',$assignedFeatureValidations.'.property_sub_type_assign_feature_id')
            ->leftjoin($validationRules,$assignedFeatureValidations.'.validation_rule_id','=',$validationRules.'.id')
            ->leftjoin($validationErrorMessages,$validationRules.'.id','=',$validationErrorMessages.'.validation_rule_id')
            ->leftjoin($appMessages,$validationErrorMessages.'.app_message_id','=',$appMessages.'.id')
            ->select(
                $propertySubTypeAssignedFeatures.'.property_sub_type_id as assignedSubTypeId',
                $propertyFeatures.'.id as featureId',$propertyFeatures.'.feature as featureName', $propertyFeatures.'.input_name as featureInputName', $propertyFeatures.'.priority as featurePriority',$propertyFeatures.'.possible_values as featurePossibleValues',
                $htmlStructures.'.id as htmlStructureId',$htmlStructures.'.structure as htmlStructureName',
                $featureSections.'.id as featureSectionId',$featureSections.'.section as featureSectionName', $featureSections.'.priority as featureSectionPriority',
                $validationRules.'.id as ruleId', $validationRules.'.rule as ruleName',
                $appMessages.'.id as appMessageId', $appMessages.'.short_message as shortMessage', $appMessages.'.long_message as longMessage'
            )->get();
    }

    public function getAssignedFeaturesWithValidationRules($subTypeId)
    {
        $propertySubTypeAssignedFeatures = 'property_sub_type_assigned_features';
        $assignedFeatureValidations = 'assigned_feature_validations';
        $propertyFeatures = $this->table;
        $featureSections = "feature_sections";
        $htmlStructures = 'html_structures';
        $validationRules = 'validation_rules';
        $validationErrorMessages = 'validation_error_messages';
        $appMessages = 'app_messages';
        return DB::table($propertySubTypeAssignedFeatures)
            ->leftjoin($propertyFeatures,$propertySubTypeAssignedFeatures.'.property_feature_id','=',$propertyFeatures.'.id')
            ->leftjoin($htmlStructures,$propertyFeatures.'.html_structure_id','=',$htmlStructures.'.id')
            ->leftjoin($featureSections,$propertyFeatures.'.feature_section_id','=',$featureSections.'.id')
            ->leftjoin($assignedFeatureValidations,$propertySubTypeAssignedFeatures.'.id','=',$assignedFeatureValidations.'.property_sub_type_assign_feature_id')
            ->leftjoin($validationRules,$assignedFeatureValidations.'.validation_rule_id','=',$validationRules.'.id')
            ->leftjoin($validationErrorMessages,$validationRules.'.id','=',$validationErrorMessages.'.validation_rule_id')
            ->leftjoin($appMessages,$validationErrorMessages.'.app_message_id','=',$appMessages.'.id')
            ->select(

                $propertySubTypeAssignedFeatures.'.property_sub_type_id as assignedSubTypeId',
                $propertyFeatures.'.id as featureId', $propertyFeatures.'.feature as featureName', $propertyFeatures.'.input_name as featureInputName', $propertyFeatures.'.priority as featurePriority', $propertyFeatures.'.possible_values as featurePossibleValues',
                $htmlStructures.'.id as htmlStructureId',$htmlStructures.'.structure as htmlStructureName',
                $featureSections.'.id as featureSectionId',$featureSections.'.section as featureSectionName', $featureSections.'.priority as featureSectionPriority',
                $validationRules.'.id as ruleId', $validationRules.'.rule as ruleName',
                $appMessages.'.id as appMessageId', $appMessages.'.short_message as shortMessage', $appMessages.'.long_message as longMessage'
            )
            ->where($propertySubTypeAssignedFeatures.'.property_sub_type_id','=',$subTypeId)
            ->get();
    }

    /**
     * @param int $propertyId
     * @return array
     * Desc: below function returns all given features of a property
     *          with sections
     * */
    public function getAPropertyFeaturesWithValues($propertyId)
    {
        $propertyFeatureValues = 'property_feature_values';
        $propertyFeatures = $this->table;
        $htmlStructures = 'html_structures';

        $featureSections = 'feature_sections';
        return  DB::table($propertyFeatureValues)
            ->leftjoin($propertyFeatures,$propertyFeatureValues.'.property_feature_id','=',$propertyFeatures.'.id')
            ->leftjoin($htmlStructures,$propertyFeatures.'.html_structure_id','=',$htmlStructures.'.id')
            ->leftjoin($featureSections,$propertyFeatures.'.feature_section_id','=',$featureSections.'.id')
            ->select(
                $propertyFeatures.'.id as featureId',$propertyFeatures.'.feature as featureName', $propertyFeatures.'.input_name as featureInputName', $propertyFeatures.'.possible_values as possibleValues',
                $propertyFeatureValues.'.value as value', $featureSections.'.id as sectionId', $featureSections.'.section as sectionName',
                $propertyFeatureValues.'.property_id as propertyId',$propertyFeatures.'.priority',
                $htmlStructures.'.id as htmlStructureId',$htmlStructures.'.structure as htmlStructureName'
            )
            ->where($propertyFeatureValues.'.property_id','=',$propertyId)
            ->get();
    }

}