<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:46 AM
 */

namespace App\Libs\Json\Prototypes\Prototypes\User;

use App\Libs\Json\Prototypes\Interfaces\JsonPrototypeInterface;
use App\Libs\Json\Prototypes\Prototypes\JsonPrototype;
use App\Models\Sql\User;

class MembershipPlanJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = null;
    public $name = "";
    public $hot = 0;
    public $featured = 0;
    public $description = "";

    public function __construct()
    {

    }
}