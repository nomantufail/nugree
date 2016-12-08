<?php
namespace App\Http\Validators\Validators;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
abstract class AppValidator
{
    public $validationMessages;
    public $authMessages;
    /* @var $request Request::class */
    public $request;
    public function __construct($request){
        $this->request = $request;
        $this->__registerCustomRules();
    }

    public function __registerCustomRules(){
        $methods = get_class_methods($this);
        $custom_rules = [];
        foreach($methods as $method){
            if(strpos($method, 'register') === 0 && strpos($method, 'Rule') > 0)
                $custom_rules[] = $method;
        }
        foreach($custom_rules as $rule){
            $this->$rule();
        }
    }

    public function getValidationMessages(){
        return $this->validationMessages;
    }

    public function setValidationMessages($messages){
        $this->validationMessages = $messages;
    }

    public function messages(){
        $messages = [
            //'required' =>'Password field is required',
            'validate_ownership' => 'Ownership Violation! Record is not under this user ownership.',
        ];
        $sub_messages = [];
        if(method_exists($this,'customValidationMessages'))
            $sub_messages = $this->customValidationMessages();
        return array_merge($messages, $sub_messages);
    }

    public  function validate(){
        $validator = Validator::make($this->request->all(), $this->rules(), $this->messages());
        if($validator->fails()){
            $this->setValidationMessages($validator->errors());
            return false;
        }
        return true;
    }

    /*
     * defining custom rules for this request
     */
    public function registerNoWhiteSpacesRule(){
        Validator::extend('no_white_spaces',function($attribute, $value, $parameters, $validator){
            if(preg_match('/\s/', $value))
            {
                return false;
            }
            return true;
        });
    }

    public function registerEqualsRule(){
        Validator::extend('equals',function($attribute, $value, $parameters, $validator){
            return ($value == $parameters[0])?true:false;
        });
    }

    public function registerMaxImageSizeRule()
    {
        Validator::extend('max_image_size', function($attribute, $value, $parameters)
        {
            $file = $this->request->file($attribute);
            $image_info = getimagesize($file);
            $image_width = $image_info[0];
            $image_height = $image_info[1];
            if( (isset($parameters[0]) && $parameters[0] != 0) && $image_width > $parameters[0]) return false;
            if( (isset($parameters[1]) && $parameters[1] != 0) && $image_height > $parameters[1] ) return false;
            return true;
        });
    }


}