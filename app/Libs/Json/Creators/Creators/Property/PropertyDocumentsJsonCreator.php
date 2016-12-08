<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;


use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;

class PropertyDocumentsJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $propertyDocuments = [];
    public function __construct(array $propertyDocuments = [])
    {
        $this->propertyDocuments = $propertyDocuments;
    }

    public function create()
    {
        $propertyDocumentsJson = [];
        foreach($this->propertyDocuments as $document /* @var $document PropertyDocument::class*/)
        {
            $propertyDocumentsJson[] = (new PropertyDocumentJsonCreator($document))->create();
        }
        return $propertyDocumentsJson;
    }
}