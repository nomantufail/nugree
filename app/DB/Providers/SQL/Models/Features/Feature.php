<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models\Features;

class Feature {

    public $id = 0;
    public $featureSectionId = 0;
    public $name;
    public $inputName;
    public $htmlStructureId;
    public $possibleValues;
    public $priority = 0;

    public $createdAt = '0000-00-00 00:00:00';
    public $updatedAt = '0000-00-00 00:00:00';

    public function __construct()
    {
        $this->possibleValues = '';
        $this->createdAt = date('Y-m-d h:i:s');
        $this->updatedAt = $this->createdAt;
    }

    public function getPossibleValues()
    {
        return explode(',',$this->possibleValues);
    }

} 

