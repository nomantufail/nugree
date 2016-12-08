<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\MailValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class ContactUSMailValidator extends MailValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[
            'email' => 'required|email|min:5|max:255',
            'message'=>'required|min:5|max:300'
        ];
    }
}

