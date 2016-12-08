<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Mail;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\MailValidators\AgentMailValidator;
use App\Http\Validators\Validators\MailValidators\WantedMailValidator;
use App\Transformers\Request\Mail\AgentMailTransformer;
use App\Transformers\Request\Mail\WantedMailTransformer;

class WantedMailRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new WantedMailTransformer($this->getOriginalRequest()));
        $this->validator = new WantedMailValidator($this);
    }

    public function authorize()
    {
        return true;
    }
    public function validate()
    {
        return $this->validator->validate();
    }
} 