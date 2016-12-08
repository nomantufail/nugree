<?php
/**
 * Created by waqas.
 * User: waqas
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Apps;

use App\Http\Requests\Request;
use App\Transformers\Transformer;

abstract class AppsRequest extends Request{

    public function __construct(Transformer $transformer){
        parent::__construct($transformer);
    }
} 