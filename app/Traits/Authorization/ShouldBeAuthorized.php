<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 8/4/2016
 * Time: 11:37 AM
 */
namespace App\Traits\Authorization;
trait ShouldBeAuthorized
{
    public function can($action, $policy, $model=null){
        $PolicyClass = ucfirst($policy)."Policy";
        $policy = new $PolicyClass();
        if($policy->$action($this, $model))
            return true;
        else
            return false;
    }
    public function cannot($action, $policy, $model = null){
        return !$this->can($action, $policy, $model);
    }
}