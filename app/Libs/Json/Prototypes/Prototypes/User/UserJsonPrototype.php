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
use App\Libs\Json\Prototypes\Prototypes\User\MembershipPlanJsonPrototype;

class UserJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
{
    public $id = null;
    public $email = "";
    public $fName = "";
    public $lName = "";
    public $phone = "";
    public $mobile = "";
    public $fax = "";
    public $address = "";
    public $zipCode = "";
    public $trustedAgent =0;
    public $country = null;
    public $roles = [];

    /**
     * @var MembershipPlanJsonPrototype::class
     * */
    public $membershipPlan = null;

    public $agencies = [];

    public $createdAt = "";
    public $updatedAt = "";
}