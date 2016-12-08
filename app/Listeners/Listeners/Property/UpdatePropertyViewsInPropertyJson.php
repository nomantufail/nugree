<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertiesStatusChanged;
use App\Events\Events\Property\UpdatePropertyTotalView;
use App\Libs\Json\Creators\Creators\Property\PropertyStatusJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;

class UpdatePropertyViewsInPropertyJson extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;
    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();
    }
   public function handle(UpdatePropertyTotalView $event)
    {
        $property = $event->property;
        $propertyJson = $this->propertiesJsonRepository->getById($property->id);
        $propertyJson->totalViews = $property->totalViews;
        return $this->propertiesJsonRepository->update($propertyJson);
    }
}
