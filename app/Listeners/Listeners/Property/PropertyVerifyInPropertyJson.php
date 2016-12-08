<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertiesStatusChanged;
use App\Events\Events\Property\PropertyVerified;
use App\Libs\Json\Creators\Creators\Property\PropertyStatusJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;

class PropertyVerifyInPropertyJson extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;
    private $propertyStatuses = null;
    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();
        $this->propertyStatuses = (new PropertyStatusesRepoProvider())->repo();
    }

    public function handle(PropertyVerified $event)
    {
        $property = $this->propertiesJsonRepository->getById($event->property->id);
        $property->isVerified = 1;
        $this->propertiesJsonRepository->update($property);
        return true;
    }
}
