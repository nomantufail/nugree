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
use App\Http\Validators\Validators\NewsValidators\DeleteNewsImageValidator;
use App\Http\Validators\Validators\ProjectValidators\DeleteProjectImageValidator;
use App\Transformers\Request\News\DeleteNewsImageTransformer;
use App\Transformers\Request\Project\DeleteProjectImageTransformer;



class DeleteNewsImageRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new DeleteNewsImageTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteNewsImageValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 