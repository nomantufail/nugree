<?php

namespace App\Listeners\Listeners\Property;

use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\Events\Events\Property\PropertyCreated;
use App\Events\Events\Property\PropertyDeleted;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;

class DeletePropertyJsonDocument extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;

    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();
    }
    /**
     * Handle the event.
     * @param  PropertyDeleted  $event
     * @return bool
     */
    public function handle(PropertyDeleted $event)
    {
        return $this->propertiesJsonRepository->delete($event->property->id);
    }
}
