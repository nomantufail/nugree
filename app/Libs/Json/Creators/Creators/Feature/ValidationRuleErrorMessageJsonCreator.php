<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/16/2016
 * Time: 9:20 AM
 */

namespace App\Libs\Json\Creators\Creators\Feature;


use App\DB\Providers\SQL\Models\AppMessage;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Feature\ValidationRuleErrorMessageJsonPrototype;

class ValidationRuleErrorMessageJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public $errorMessage = null;
    public $model = null;
    public function __construct(AppMessage  $errorMessage)
    {
        $this->errorMessage = $errorMessage;
       $this->model = new ValidationRuleErrorMessageJsonPrototype();
    }
    public function create()
    {
        $this->model->shortMessage = $this->errorMessage->shortMessage;
        $this->model->longMessage  = $this->errorMessage->longMessage;
        return $this->model;
    }
}