<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\MailValidators;


use App\Http\Validators\Interfaces\ValidatorsInterface;

class WantedMailValidator extends MailValidator implements ValidatorsInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }
    public function rules()
    {
        return[

            'email' => 'required|email|min:5|max:255',
            'phone'=>'required|min:11|max:25',
            'requirements'=>'required|min:3|max:300'
        ];
    }
}

