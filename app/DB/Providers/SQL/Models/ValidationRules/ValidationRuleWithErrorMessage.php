<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:17 AM
 **/

namespace App\DB\Providers\SQL\Models\ValidationRules;

use App\DB\Providers\SQL\Models\AppMessage;

class ValidationRuleWithErrorMessage {

    public $ruleId = 0;
    public $name;

    /* @var $errorMessage AppMessage::class*/
    public $errorMessage = null;

    public function __construct()
    {

    }
} 

