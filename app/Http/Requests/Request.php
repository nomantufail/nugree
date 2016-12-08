<?php

namespace App\Http\Requests;

use App\Repositories\Repositories\Sql\UsersRepository;
use App\Traits\RequestHelper;
use App\Transformers\Transformer;

abstract class Request
{
    use RequestHelper;

    private $transformedValues = [];
    private $transformer = null;
    public $authenticator = null;
    public $user = null;
    public function __construct(Transformer $transformer){
        $this->transformer = $transformer;
        $this->transformedValues = $this->transformer->transform();
        $this->authenticator = $this->getRequestAuthenticator();
        $this->user = new UsersRepository();
    }
    public function user()
    {
        if($this->isApi())
            return $this->user->getByToken($this->authenticator->getAccessToken());
        else

            return (isset($_SESSION['authUser']))?$_SESSION['authUser']:null;

    }
    public function get($key){
        return (isset($this->transformedValues[$key]))?$this->transformedValues[$key]:null;
    }

    public function getOriginal($key){
        return request()->get($key);
    }

    public function all(){
        return $this->transformedValues;
    }

    public function allOriginal(){
        return request()->all();
    }

    public function file($file)
    {
        return $this->getOriginalRequest()->file($file);
    }

    public function has($file)
    {
        return ($this->file($file) != null)?true:false;
    }
    public function getOriginalRequest()
    {
        return request();
    }

    /*
     * tells weather the request is authentic.
     */
    public function authentic(){
        return $this->authenticator->authenticate();
    }

    /*
     * tells weather the request is not authentic.
     */
    public function isNotAuthentic(){
        return (!$this->authentic())?true: false;
    }

}
