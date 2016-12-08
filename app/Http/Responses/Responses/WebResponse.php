<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 1:46 PM
 */

namespace App\Http\Responses\Responses;

use App\Http\Responses\Interfaces\ResponseInterface;
use App\Http\Responses\Response as AppResponse;
class WebResponse extends AppResponse implements ResponseInterface
{
    private $view = 'defaultView';
    private $redirectTo = '';
    public function __construct(){}

    /**
     * @param array $response
     * @param array $headers
     * @return $this
     */
    public function respond(array $response, array $headers = []){
        $http_status = $this->getHttpStatus();
        $response['status'] = ($http_status == 200)?1:0;
        $response['message'] = (isset($data['message']))?$data['message']:config('constants.SUCCESS_MESSAGE');
        return view($this->getView())->with('response',$response);
    }

    /**
     * @return $this
     */
    public function respondWithErrors(){
        \Session::flash('errors',$this->getErrorMessages());
        return $this->redirect()->withInput();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function respondWithValidationErrors()
    {
        \Session::flash('validationErrors',$this->getErrorMessages());
        return $this->redirect()->withInput();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectBack()
    {
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return $this->getRedirectTo() == '' ? $this->redirectBack() : redirect()->route($this->getRedirectTo());
    }

    /**
     * @param $appName
     * @param $version
     * @param array $data
     * @return $this
     */
    public function app($appName, $version, $data = ['data'=>''])
    {
        if(!isset($data['version']))
            $data['version'] = $version;

        $appPath = 'apps.'.$appName.'.'.$version.'.app';
        return $this->setView($appPath)->respond($data);
    }

    /**
     * @param $viewName
     * @return $this
     */
    public function setView($viewName)
    {
        $this->view = $viewName;
        return $this;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }


    /**
     * @return string
     */
    public function getRedirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * @param string $redirectTo
     * @return $this
     */
    public function setRedirectTo($redirectTo)
    {
        $this->redirectTo = $redirectTo;
        return $this;
    }

}