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
use App\Http\Validators\Validators\MailValidators\MailFeedbackUsValidator;
use App\Http\Validators\Validators\MailValidators\MailToAgentValidator;
use App\Transformers\Request\Mail\MailFeedbackUsTransformer;
use App\Transformers\Request\Mail\MailToAgentTransformer;


class MailFeedbackUsRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new MailFeedbackUsTransformer($this->getOriginalRequest()));
        $this->validator = new MailFeedbackUsValidator($this);
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