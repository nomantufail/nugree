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
use App\Http\Validators\Validators\NewsValidators\GetNewsImagesValidator;
use App\Http\Validators\Validators\ProjectValidators\GetProjectImagesValidator;
use App\Transformers\Request\News\GetNewsImagesTransformer;
use App\Transformers\Request\Project\GetProjectImagesTransformer;


class GetNewsImagesRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetNewsImagesTransformer($this->getOriginalRequest()));
        $this->validator = new GetNewsImagesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 