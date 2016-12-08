<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Requests\Agency\AddAgencyRequest;
use App\Http\Requests\Requests\Agency\AddAgencyStaffRequest;
use App\Http\Requests\Requests\Agency\DeleteAgencyRequest;
use App\Http\Requests\Requests\Agency\DeleteAgencyStaffRequest;
use App\Http\Requests\Requests\Agency\GetAgencyStaffRequest;
use App\Http\Requests\Requests\Agency\UpdateAgencyRequest;
use App\Http\Requests\Requests\Agency\UpdateAgencyStaffRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\AgenciesRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use Illuminate\Support\Facades\File;

class AgencyController extends ApiController
{
    private $agency = null;
    public $response = null;
    public $userRepo =null;
    public function __construct(
        ApiResponse $response,
        AgenciesRepoProvider $agenciesRepository,
        UsersRepoProvider $usersRepoProvider

    )
    {
        $this->userRepo = $usersRepoProvider->repo();
        $this->agency =  $agenciesRepository->repo();
        $this->response = $response;
    }

    public function store(AddAgencyRequest $request)
    {
        $agency = $request->getAgencyModel();
        $agency->id = $this->agency->storeAgency($agency);
        return $this->response->respond(['data' => [
            'agency' => $agency
        ]]);
    }
    public function getStaff(GetAgencyStaffRequest $staff)
    {
         $staff = $this->userRepo->getAgencyStaff($staff->get('agencyId'));
         return $this->response->respond(['data' => [
            'staff' => $staff
        ]]);
    }
    public function update(UpdateAgencyRequest $request)
    {
        $agency =$request->getAgencyModel();
        $this->agency->updateAgency($agency);
        return $this->response->respond(['data' => [
            'staff' => $agency
        ]]);
    }
    public function addAgencyStaff(AddAgencyStaffRequest $request)
    {
        $agencyStaff = $request->getAgencyStaffModel();
        $agencyStaff->id = $this->userRepo->store($agencyStaff);
        return $this->response->respond(['data' => [
        'agencyStaff' => $agencyStaff
    ]]);
    }

    public function updateAgencyStaff(UpdateAgencyStaffRequest $request)
    {
        $agencyStaff = $request->getAgencyStaffModel();
        $this->userRepo->update($agencyStaff);
        return $this->response->respond(['data' => [
            'agencyStaff' => $agencyStaff
        ]]);
    }
    public function deleteAgencyStaff(DeleteAgencyStaffRequest $request)
    {
        $agencyStaff = $request->getAgencyStaffModel();
        $this->userRepo->delete($agencyStaff);
        return $this->response->respond(['data' => [
            'agencyStaff' => $agencyStaff
        ]]);
    }
    public function delete(DeleteAgencyRequest $request)
    {
        $this->agency->deleteAgency($request->getAgencyModel());
        File::delete(storage_path('app/'.$request->getAgencyModel()->logo));
        return $this->response->respond(['data'=>[],'message'=>'deleted successfully']);
    }
}
