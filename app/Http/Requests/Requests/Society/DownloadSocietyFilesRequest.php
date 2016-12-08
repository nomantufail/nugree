<?php
/**
 * Created by waqas.
 * User: waqas
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Society;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\SocietyValidators\DownloadSocietyFilesValidator;
use App\Http\Validators\Validators\SocietyValidators\GetSocietyFilesValidator;
use App\Http\Validators\Validators\SocietyValidators\GetSocietyMapsValidator;
use App\Transformers\Request\Society\DownloadSocietyFilesTransformer;
use App\Transformers\Request\Society\GetSocietyFilesTransformer;
use App\Transformers\Request\Society\GetSocietyMapsTransformer;

class DownloadSocietyFilesRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new DownloadSocietyFilesTransformer($this->getOriginalRequest()));
        $this->validator =  new DownloadSocietyFilesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 