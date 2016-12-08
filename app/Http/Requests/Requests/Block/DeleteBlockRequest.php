<?php
/**
 * Created by WAQAS
 * User: waqas
 * Date: 4/8/2016
 * Time: 11:26 AM
 */

namespace App\Http\Requests\Requests\Block;

use App\DB\Providers\SQL\Models\Block;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\BlockValidators\DeleteBlockValidator;
use App\Transformers\Request\Block\DeleteBlockTransformer;

class DeleteBlockRequest extends Request implements RequestInterface
{
    public $validator = null;
    public function __construct(){
        parent::__construct(new DeleteBlockTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteBlockValidator($this);
    }
    public function authorize()
    {}
    public function validate(){
        return $this->validator->validate();
    }
    public function getBlockModel()
    {
        $block = new Block();
        $block->id = $this->get('id');
        return $block;
    }

}