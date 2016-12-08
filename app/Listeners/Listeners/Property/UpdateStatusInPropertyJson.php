<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertiesStatusChanged;
use App\Events\Events\Property\PropertyStatusUpdated;
use App\Libs\Json\Creators\Creators\Property\PropertyStatusJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;

class UpdateStatusInPropertyJson extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;
    private $propertyStatuses = null;
    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();
        $this->propertyStatuses = (new PropertyStatusesRepoProvider())->repo();
    }

    public function handle(PropertyStatusUpdated $event)
    {
        $property = $this->propertiesJsonRepository->getById($event->property->id);
        $propertyStatus = $this->propertyStatuses->getById($event->property->statusId);
        $property->propertyStatus = (new PropertyStatusJsonCreator($propertyStatus))->create();
        $this->propertiesJsonRepository->update($property);
        return true;
    }
}
