<?php
/**
 * Created by PhpStorm.
 * User: Waqas
 * Date: 4/4/2016
 * Time: 2:33 PM
 */

namespace App\Http\Requests\Requests\PropertyDocument;

use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyDocumentValidators\AddPropertyDocumentValidator;
use App\Transformers\Request\PropertyDocument\AddPropertyDocumentTransformer;

class AddPropertyDocumentRequest extends Request implements  RequestInterface
{
    public $validator =null;
    public function __construct()
    {
        parent::__construct(new AddPropertyDocumentTransformer($this->getOriginalRequest()));
        $this->validator = new AddPropertyDocumentValidator($this);
    }
    public function getPropertyDocumentModel()
    {
        $propertyDocument = new PropertyDocument();
        $propertyDocument->propertyId = $this->get('property_id');
        $propertyDocument->type = $this->get('type');
        $propertyDocument->path = $this->get('path');
        $propertyDocument->title = $this->get('title');
        return $propertyDocument;
    }
    public function authorize(){}

    public function validate()
    {
       return $this->validator->validate();
    }
}