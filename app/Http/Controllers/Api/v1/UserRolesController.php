<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\UserRole\AddUserRoleRequest;
use App\Http\Requests\Requests\UserRole\DeleteUserRoleRequest;
use App\Http\Requests\Requests\UserRole\GetAllUserRolesRequest;
use App\Http\Requests\Requests\UserRole\UpdateUserRoleRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\UserRolesRepoProvider;

class UserRolesController extends ApiController
{
    private $userRole = null;
    public $response = null;
    public function __construct
    (
        UserRolesRepoProvider $userRolesRepoProvider,
        ApiResponse $response
    )
    {
        $this->userRole = $userRolesRepoProvider->repo();
        $this->response = $response;
    }

    public function store(AddUserRoleRequest $request)
    {
        $userRole =$request->getUserRoleModel();
        $userRole->id = $this->userRole->store($userRole);
        return $this->response->respond(['data' => [
            'userRole' => $userRole
        ]]);
    }

    public function all(GetAllUserRolesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'userRole'=>$this->userRole->all()
        ]]);
    }
    public function delete(DeleteUserRoleRequest $request)
    {
        return $this->response->respond(['data'=>[
            'userRole'=>$this->userRole->delete($request->getUserRoleModel())
        ]]);
    }
    public function update(UpdateUserRoleRequest $request)
    {
        $userRole =$request->getUserRoleModel();
        $this->userRole->update($userRole);
        return $this->response->respond(['data' => [
            'userRole' => $userRole
        ]]);
    }


}