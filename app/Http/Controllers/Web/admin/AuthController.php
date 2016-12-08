<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Auth\AdminLoginRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\AdminsRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use PropertyFilesReleaser;
    public $adminRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->adminRepo = (new AdminsRepoProvider())->repo();
    }
    public function getLoginPage()
    {
        return $this->response->setView('admin.Auth.login')->respond(['data'=>'']);
    }
    public function login(AdminLoginRequest $request)
    {
        $admin = $this->adminRepo->getAdmin($request->getCredentials());
        if(sizeof($admin) >0)
        {
            Session::set('admin',$admin);
            return redirect('maliksajidawan786@gmail.com/agents');
        }
    }
}
