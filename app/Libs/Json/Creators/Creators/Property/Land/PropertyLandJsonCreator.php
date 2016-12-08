<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Land;

use App\DB\Providers\SQL\Models\Property;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Land\PropertyLandJsonPrototype;
use App\Repositories\Repositories\Sql\LandUnitsRepository;

class PropertyLandJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    private $landUnitsRepository = null;

    /**
     * @param Property|null $property
     */
    public function __construct(Property $property = null)
    {
        $this->model = $property;
        $this->prototype = new PropertyLandJsonPrototype();
        $this->landUnitsRepository = new LandUnitsRepository();
    }

    public function create()
    {
        $model = clone($this->model);
        $this->prototype->area = $model->landArea;
        $this->prototype->unit = $this->getLandUnit();
        return $this->prototype;
    }

    public function getLandUnit()
    {
        $landUnit = $this->landUnitsRepository->getById($this->model->landUnitId);
        return (new PropertyLandUnitJsonCreator($landUnit))->create();
    }

}