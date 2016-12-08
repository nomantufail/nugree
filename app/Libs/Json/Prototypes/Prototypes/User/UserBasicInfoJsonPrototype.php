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

class UserBasicInfoJsonPrototype extends JsonPrototype implements JsonPrototypeInterface
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
    public $access_token = "";

    public function __construct()
    {

    }
}