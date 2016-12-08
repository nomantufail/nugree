<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertiesStatusChanged;
use App\Libs\Json\Creators\Creators\Property\PropertyStatusJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;

class UpdatePropertiesStatusInJson extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;
    private $propertyStatuses = null;
    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();
        $this->propertyStatuses = (new PropertyStatusesRepoProvider())->repo();
    }
    /**
     * Handle the event.
     * @param  PropertiesStatusChanged  $event
     * @return bool
     */
    public function handle(PropertiesStatusChanged $event)
    {
        $properties = $this->propertiesJsonRepository->getByIds($event->propertyIds);
        $propertyStatus = $this->propertyStatuses->getById($event->propertyStatusId);
        foreach($properties as $property){
            $property->propertyStatus = (new PropertyStatusJsonCreator($propertyStatus))->create();
        }

        foreach($properties as $property){
            $this->propertiesJsonRepository->update($property);
        }
        return true;
    }
}
