<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Role\AddRoleRequest;
use App\Http\Requests\Requests\Role\DeleteRoleRequest;
use App\Http\Requests\Requests\Role\GetAllRolesRequest;
use App\Http\Requests\Requests\Role\UpdateRoleRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\RolesRepoProvider;

class RolesController extends ApiController
{
    private $roles = null;
    public $response = null;
    public function __construct
    (
        RolesRepoProvider $RolesRepoProvider,
        ApiResponse $response
    )
    {
        $this->roles= $RolesRepoProvider->repo();
        $this->response = $response;
    }

    public function store(AddRoleRequest $request)
    {
        $role = $request->getRoleModel();
        $role->id = $this->roles->store($role);
        return $this->response->respond(['data' => [
            'roles' => $role
        ]]);
    }

    public function all(GetAllRolesRequest $request)
    {
        return $this->response->respond(['data'=>[
            'roles'=>$this->roles->all()
        ]]);
    }
    public function delete(DeleteRoleRequest $request)
    {
        return $this->response->respond(['data'=>[
            'roles'=>$this->roles->delete($request->getRoleModel())
        ]]);
    }
    public function update(UpdateRoleRequest $request)
    {
        $userRole =$request->getRoleModel();
        $this->roles->update($userRole);
        return $this->response->respond(['data' => [
            'roles' => $userRole
        ]]);
    }


}