<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request;


use App\Transformers\Transformer;

class RequestTransformer extends Transformer{
    public $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
} 