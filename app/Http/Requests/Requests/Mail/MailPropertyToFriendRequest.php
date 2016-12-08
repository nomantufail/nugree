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
use App\Http\Validators\Validators\MailValidators\MailPropertyToFriendValidator;
use App\Transformers\Request\Mail\MailPropertyToFriendTransformer;

class MailPropertyToFriendRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new MailPropertyToFriendTransformer($this->getOriginalRequest()));
        $this->validator = new MailPropertyToFriendValidator($this);
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