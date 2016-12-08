<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/7/2016
 * Time: 10:43 AM
 */

namespace App\Http\Requests\Requests\Block;

use App\DB\Providers\SQL\Models\Block;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\BlockValidators\AddBlockValidator;
use App\Transformers\Request\Block\AddBlockTransformer;

class AddBlockRequest extends Request implements RequestInterface
{
    public $validator;
    public function __construct()
    {
        parent::__construct(new AddBlockTransformer($this->getOriginalRequest()));
        $this->validator = new AddBlockValidator($this);
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
        $block->name = $this->get('block');
        $block->societyId = $this->get('societyId');
        return $block;
    }
}