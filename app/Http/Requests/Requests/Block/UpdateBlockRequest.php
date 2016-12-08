<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/8/2016
 * Time: 10:23 AM
 */

namespace App\Http\Requests\Requests\Block;


use App\DB\Providers\SQL\Models\Block;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\BlockValidators\UpdateBlockValidator;
use App\Transformers\Request\Block\UpdateBlockTransformer;

class UpdateBlockRequest extends Request implements RequestInterface
{
    public $validator;
    public function __construct()
    {
        parent::__construct(new UpdateBlockTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateBlockValidator($this);
    }
    public function authorize()
    {}
    public function validate()
    {
        return $this->validator->validate();
    }
    public function getBlockModel()
    {
        $block = new Block();
        $block->id = $this->get('id');
        $block->name = $this->get('block');
        $block->societyId = $this->get('societyId');
        return $block;
    }

}