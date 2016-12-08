<?php

namespace App\Http\Controllers\Web\Admin;

use App\DB\Providers\SQL\Factories\Factories\FavouriteProperty\FavouritePropertyFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Admin\GetAdminActivePropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminDeletedPropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminExpiredPropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminPendingPropertyRequest;
use App\Http\Requests\Requests\Admin\GetAdminRejectedPropertyRequest;
use App\Http\Requests\Requests\Block\AddBlockRequest;
use App\Http\Requests\Requests\Block\DeleteBlockRequest;
use App\Http\Requests\Requests\Block\GetBlocksBySocietyRequest;
use App\Http\Requests\Requests\Block\GetUpdateBlockFormRequest;
use App\Http\Requests\Requests\Block\UpdateBlockRequest;
use App\Http\Requests\Requests\Property\ApprovePropertyRequest;
use App\Http\Requests\Requests\Property\DeActivePropertyRequest;
use App\Http\Requests\Requests\Property\DeVerifyPropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminPropertyRequest;
use App\Http\Requests\Requests\Property\GetAdminsPropertiesRequest;
use App\Http\Requests\Requests\Property\RejectPropertyRequest;
use App\Http\Requests\Requests\Property\VerifyPropertyRequest;
use App\Http\Requests\Requests\Society\AddSocietyRequest;
use App\Http\Requests\Requests\Society\DeleteSocietyRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesRequest;
use App\Http\Requests\Requests\Society\GetUpdateSocietyFormRequest;
use App\Http\Requests\Requests\Society\UpdateSocietyRequest;
use App\Http\Requests\Requests\User\ApproveAgentRequest;
use App\Http\Requests\Requests\User\GetAdminAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\BlocksRepoProvider;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;

class AdminController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper;
    public $users = null;
    public $response = null;
    public $properties = null;
    public $favouriteFactory = null;
    public $propertiesRepo = null;
    public $usersRepo = null;
    public $factoryRepo = null;
    public $societyRepo = null;
    public $blocksRepo = null;

    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
        $this->propertiesRepo = (new PropertiesRepoProvider())->repo();
        $this->users = (new UsersJsonRepoProvider())->repo();
        $this->usersRepo = (new UsersRepoProvider())->repo();
        $this->favouriteFactory = new FavouritePropertyFactory();
        $this->factoryRepo = (new SocietiesRepoProvider())->repo();
        $this->societyRepo = (new SocietiesRepoProvider())->repo();
        $this->blocksRepo = (new BlocksRepoProvider())->repo();
    }

    public function getProperties(GetAdminsPropertiesRequest $request)
    {
        $properties = $this->properties->getAllProperties();
        return $this->response->setView('admin.properties')->respond(['data' => [
            'properties' => $properties,
            'propertiesCount' => count($properties)
        ]]);
    }

    public function getActiveProperties(GetAdminActivePropertyRequest $request)
    {
        $properties = $this->properties->getActiveProperties();

        return $this->response->setView('admin.properties')->respond(['data' => [
            'properties' => $properties,
            'propertiesCount' => count($properties)
        ]]);
    }

    public function getPendingProperties(GetAdminPendingPropertyRequest $request)
    {
        $properties = $this->properties->getPendingProperties();
        return $this->response->setView('admin.properties')->respond(['data' => [
            'properties' => $properties,
            'propertiesCount' => count($properties)
        ]]);
    }

    public function getExpiredProperties(GetAdminExpiredPropertyRequest $request)
    {
        $properties = $this->properties->getExpiredProperties();
        return $this->response->setView('admin.properties')->respond(['data' => [
            'properties' => $properties,
            'propertiesCount' => count($properties)
        ]]);
    }

    public function getRejectedProperties(GetAdminRejectedPropertyRequest $request)
    {
        $properties = $this->properties->getRejectedProperties();
        return $this->response->setView('admin.properties')->respond(['data' => [
            'properties' => $properties,
            'propertiesCount' => count($properties)
        ]]);
    }

    public function getDeletedProperties(GetAdminDeletedPropertyRequest $request)
    {
        $properties = $this->properties->getDeletedProperties();
        return $this->response->setView('admin.properties')->respond(['data' => [
            'properties' => $properties,
            'propertiesCount' => count($properties)
        ]]);
    }

    public function getById(GetAdminPropertyRequest $request)
    {
        $loggedInUser = $request->user();
        $property = $this->convertPropertyAreaToActualUnit($this->properties->getById($request->get('propertyId')));
        return $this->response->setView('admin.property-detail')->respond(['data' => [
            'isFavourite' => ($loggedInUser == null) ? false : $this->favouriteFactory->isFavourite($request->get('propertyId'), $loggedInUser->id),
            'property' => $this->releaseAllPropertiesFiles([$property])[0],
            'loggedInUser' => $loggedInUser,
            'user' => $this->users->find($property->owner->id)
        ]]);
    }

    public function rejectProperty(RejectPropertyRequest $request)
    {
        $this->propertiesRepo->rejectProperty($request->getPropertyModel());
        return redirect('get/property');
    }

    public function VerifyProperty(VerifyPropertyRequest $request)
    {
        $this->propertiesRepo->VerifyProperty($request->getPropertyModel());
        return redirect('get/property');
    }

    public function deVerifyProperty(DeVerifyPropertyRequest $request)
    {
        $this->propertiesRepo->deVerifyProperty($request->getPropertyModel());
        return redirect('get/property');
    }

    public function approveProperty(ApprovePropertyRequest $request)
    {
        $this->propertiesRepo->approveProperty($request->getPropertyModel());
        return redirect('get/property');
    }

    public function deActiveProperty(DeActivePropertyRequest $request)
    {
        $this->propertiesRepo->deActiveProperty($request->getPropertyModel());
        return redirect('get/property');
    }

    public function getAgents()
    {
        return $this->response->setView('admin.pending-Agents')->respond(['data' => [
            'agents' => $this->users->getPendingAgents(),
        ]]);
    }

    public function approveAgent(ApproveAgentRequest $request)
    {
        $this->usersRepo->approveAgent($request->getUserModel());
        return redirect('maliksajidawan786@gmail.com/agents');
    }

    public function getAgent(GetAdminAgentRequest $request)
    {
        return $this->response->setView('admin.agent_profile')->respond(['data' => [
            'agent' => $this->users->find($request->get('userId'))]]);
    }

    public function societies(GetAllSocietiesRequest $request)
    {
        return $this->response->setView('admin.society.society-listing')->respond(['data' => [
            'societies' => $this->factoryRepo->all()
        ]]);
    }

    public function deleteSociety(DeleteSocietyRequest $request)
    {
        $this->societyRepo->delete($request->getSocietyModel());
        return redirect('maliksajidawan786@gmail.com/societies');
    }

    public function getUpdateSocietyForm(GetUpdateSocietyFormRequest $request)
    {
        return $this->response->setView('admin.society.update-form')->respond(['data'=>[
            'society'=>$this->societyRepo->getById($request->get('societyId'))
        ]]);
    }
    public function getSocietyForm()
    {
       return $this->response->setView('admin.society.society_form')->respond([]);
    }
    public function updateSociety(UpdateSocietyRequest $request)
    {
        $this->societyRepo->update($request->getSocietyModel());
        return redirect('maliksajidawan786@gmail.com/societies');
    }
    public function addSociety(AddSocietyRequest $request)
    {
        $this->societyRepo->store($request->getSocietyModel());
        return redirect('get/society/form');
    }

    public function getBlocks()
    {
        return $this->response->setView('admin.block.block-listing')->respond(['data'=>[
            'societies'=>$this->societyRepo->all()
        ]]);
    }
    public function addBlock(AddBlockRequest $request)
    {
        $this->blocksRepo->store($request->getBlockModel());
        return $this->response->setView('admin.block.block-listing')->respond(['data'=>[
            'blocks'=>$this->blocksRepo->getBlocksBySociety($request->get('societyId')),
            'societyId'=>$request->get('societyId'),
            'societies'=>$this->societyRepo->all()
        ]]);
    }
    public function deleteBlock(DeleteBlockRequest $request)
    {
        $this->blocksRepo->delete($request->getBlockModel());
        return $this->response->setView('admin.block.block-listing')->respond(['data'=>[
            'blocks'=>$this->blocksRepo->getBlocksBySociety($request->get('societyId')),
            'societyId'=>$request->get('societyId'),
            'societies'=>$this->societyRepo->all()
        ]]);
    }

    public function getBlockUpdateForm(GetUpdateBlockFormRequest $request)
    {
        return $this->response->setView('admin.block.update_block_form')->respond(['data'=>[
            'block'=>$this->blocksRepo->getById($request->getBlockModel()->id),
            'societies'=>$this->societyRepo->all(),
            'societyId'=>$request->get('societyId'),
        ]]);
    }

    public function getBlocksBySociety(GetBlocksBySocietyRequest $request)
    {
        return $this->response->setView('admin.block.block-listing')->respond(['data'=>[
            'blocks'=>$this->blocksRepo->getBlocksBySociety($request->get('societyId')),
            'societyId'=>$request->get('societyId'),
            'societies'=>$this->societyRepo->all()
        ]]);
    }

    public function updateBlock(UpdateBlockRequest $request)
    {
        $this->blocksRepo->update($request->getBlockModel());
        return $this->response->setView('admin.block.block-listing')->respond(['data'=>[
            'blocks'=>$this->blocksRepo->getBlocksBySociety($request->get('societyId')),
            'societyId'=>$request->get('societyId'),
            'societies'=>$this->societyRepo->all()
        ]]);
    }
}
