<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 9:15 AM
 */

namespace App\Http\Requests\Requests\PropertyDocument;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;

use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Http\Validators\Validators\PropertyDocumentyValidators\UpdatePropertyDocumentValidator;
use App\Transformers\Request\PropertyDocuments\UpdatePropertyDocumentTransformer;

class UpdatePropertyDocumentRequest extends Request implements RequestInterface
{
    public $validator =null;
    public function __construct()
    {
        parent::__construct(new UpdatePropertyDocumentTransformer($this->getOriginalRequest()));
        $this->validator = new UpdatePropertyDocumentValidator($this);
    }
    public function authorize()
    {}

    public function validate()
    {
        return $this->validator->validate();
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
}