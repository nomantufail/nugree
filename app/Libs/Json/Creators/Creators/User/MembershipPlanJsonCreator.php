<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\User;

use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\User\MembershipPlanJsonPrototype;
use App\DB\Providers\SQL\Models\MembershipPlan;

class MembershipPlanJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(MembershipPlan $plan = null)
    {
        $this->model = $plan;
        $this->prototype = new MembershipPlanJsonPrototype();
    }

    public function create()
    {
        $this->prototype->id = $this->model->id;
        $this->prototype->name = $this->model->name;
        $this->prototype->hot = $this->model->hot;
        $this->prototype->featured = $this->model->featured;
        $this->prototype->description = $this->model->description;
        return $this->prototype;
    }
}