<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */
namespace App\Http\Requests\Requests;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\IndexValidator;
use App\Transformers\Request\IndexTransformer;

class IndexRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new IndexTransformer($this->getOriginalRequest()));
        $this->validator = new IndexValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 