<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\Requests\Block\AddBlockRequest;
use App\Http\Requests\Requests\Block\DeleteBlockRequest;
use App\Http\Requests\Requests\Block\GetAllBlocksRequest;
use App\Http\Requests\Requests\Block\UpdateBlockRequest;
use App\Http\Requests\Requests\Block\GetBlocksBySocietyRequest;
use App\Http\Responses\Responses\ApiResponse;
use App\Repositories\Providers\Providers\BlocksRepoProvider;

class BlocksController extends ApiController
{
    private $block = null;
    public $response = null;
    public function __construct
    (
        BlocksRepoProvider $blocksRepository,
        ApiResponse $response
    )
    {
        $this->block  = $blocksRepository->repo();
        $this->response = $response;
    }

    public function store(AddBlockRequest $request)
    {
        $block =$request->getBlockModel();
        $block->id = $this->block->store($block);
        return $this->response->respond(['data' => [
            'block' => $block
        ]]);
    }

    public function all(GetAllBlocksRequest $request)
    {
        return $this->response->respond(['data'=>[
            'blocks'=>$this->block->all()
        ]]);
    }
    public function delete(DeleteBlockRequest $request)
    {
        return $this->response->respond(['data'=>[
            'block'=>$this->block->delete($request->getBlockModel())
        ]]);
    }
    public function update(UpdateBlockRequest $request)
    {
        $block =$request->getBlockModel();
        $this->block->update($block);
        return $this->response->respond(['data' => [
            'block' => $block
        ]]);
    }

    public function getBySociety(GetBlocksBySocietyRequest $request)
    {
        return $this->response->respond(['data'=>[
            'block'=>$this->block->getBySociety($request->get('societyId'))
            ]]);
    }
    public function getBlocksBySociety(GetBlocksBySocietyRequest $request)
    {
            return $this->response->respond(['data'=>[
            'blocks'=>$this->block->getBlocksBySociety($request->get('societyId'))]]);
    }
}