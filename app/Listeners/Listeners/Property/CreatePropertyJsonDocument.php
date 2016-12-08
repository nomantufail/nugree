<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertyCreated;
use App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;
use Illuminate\Support\Facades\Mail;

class CreatePropertyJsonDocument extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;
    private $userReop = null;

    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();
        $this->userReop = (new UsersRepoProvider())->repo();
    }

    /**
     * Handle the event.
     *
     * @param  PropertyCreated  $event
     * @return bool
     */
    public function handle(PropertyCreated $event)
    {
        $propertyJsonCreator = new PropertyJsonCreator($event->property);
        $propertyJson = $propertyJsonCreator->create();
        return $this->propertiesJsonRepository->store($propertyJson);
    }
}
