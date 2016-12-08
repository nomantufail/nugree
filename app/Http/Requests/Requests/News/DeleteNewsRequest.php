<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\News;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\NewsValidators\DeleteNewsValidator;
use App\Transformers\Request\News\DeleteNewsTransformer;


class DeleteNewsRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new DeleteNewsTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteNewsValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 