<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 12:39 PM
 */

namespace App\Http\Requests\Interfaces;


interface RequestInterface
{
    public function authorize();

    public function validate();
}