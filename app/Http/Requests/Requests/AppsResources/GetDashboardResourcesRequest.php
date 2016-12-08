<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */
namespace App\Http\Requests\Requests\AppsResources;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AppResourcesValidators\GetDashboardResourcesValidator;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Transformers\Request\AppResources\GetDashboardResourcesTransformer;

class GetDashboardResourcesRequest extends Request implements RequestInterface{

    public $validator = null;
    public $users = null;
    public function __construct(){
        parent::__construct(new GetDashboardResourcesTransformer($this->getOriginalRequest()));
        $this->validator = new GetDashboardResourcesValidator($this);
        $this->users = (new UsersJsonRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function getUserJsonModel()
    {
        if(isset($_SESSION['authUser']) && $_SESSION['authUser'] != null)
            return $this->users->find($_SESSION['authUser']->id);
        return null;

    }

    public function validate(){
        return $this->validator->validate();
    }
}