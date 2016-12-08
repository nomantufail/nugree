<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property;

use App\DB\Providers\SQL\Models\Features\PropertyFeatureValueAndSection;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyDocumentJsonPrototype;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyFeatureJsonPrototype;

class PropertyDocumentJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyDocument $document = null)
    {
        $this->model = $document;
        $this->prototype = new PropertyDocumentJsonPrototype();
    }

    public function create()
    {
        $model = clone($this->model);

        $this->prototype->id = $model->id;
        $this->prototype->path = $model->path;
        $this->prototype->title = $model->title;
        $this->prototype->type = $model->type;
        $this->prototype->main = $model->main;

        return $this->prototype;
    }

}