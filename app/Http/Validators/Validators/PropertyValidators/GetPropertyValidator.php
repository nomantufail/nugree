<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 4:15 PM
 */

namespace App\Http\Validators\Validators\PropertyValidators;

use App\Http\Validators\Interfaces\ValidatorsInterface;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use Illuminate\Support\Facades\Validator;
class GetPropertyValidator extends PropertyValidator implements ValidatorsInterface
{
    private $propertyJson =null;
    private $status = null;
    public function __construct($request)
    {
        parent::__construct($request);
        $this->propertyJson = (new PropertiesJsonRepoProvider())->repo();
        $this->status = new \PropertyStatusTableSeeder();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            //'propertyId'=>'required',
            'propertySlug'=>'required'
        ];
    }

    public function registerActivePropertyRule()
    {
        Validator::extend('active_property', function($attribute, $value, $parameters)
        {
            try{
                $property = $this->propertyJson->getById($this->request->get('propertyId'));
                $isActive = false;
                if($property->propertyStatus->id == $this->status->getActiveStatusId())
                    {
                        $isActive = true;
                    }
                if( !$isActive)
                    return false;

            }catch (\Exception $e){
                return false;
            }

            return true;
        });
    }
}

