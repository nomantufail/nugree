<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Project;

use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\ProjectValidators\DeleteProjectImageValidator;
use App\Transformers\Request\Project\DeleteProjectImageTransformer;



class DeleteProjectImageRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new DeleteProjectImageTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteProjectImageValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 