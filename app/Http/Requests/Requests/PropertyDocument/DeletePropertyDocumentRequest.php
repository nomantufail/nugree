<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/5/2016
 * Time: 10:25 AM
 */

namespace App\Http\Requests\Requests\PropertyDocument;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyDocumentValidators\DeletePropertyDocumentValidator;
use App\Repositories\Providers\Providers\PropertyDocumentsRepoProvider;
use App\Repositories\Repositories\Sql\PropertyDocumentsRepository;
use App\Transformers\Request\PropertyDocument\DeletePropertyDocumentTransformer;

class DeletePropertyDocumentRequest extends Request implements RequestInterface
{
    private $propertyDocument = null;
    public $validator = null;
    public function __construct()
    {
        parent::__construct(new DeletePropertyDocumentTransformer($this->getOriginalRequest()));
        $this->validator = new DeletePropertyDocumentValidator($this);
        $this->propertyDocument = (new PropertyDocumentsRepoProvider())->repo();
    }
    public function getPropertyDocumentModel()
    {
        $propertyDocument = $this->propertyDocument->getById($this->get('id'));
        return $propertyDocument;
    }
    public function authorize(){}

    public function validate()
    {
        return $this->validator->validate();
    }
}