<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertyCreated;
use App\Events\Events\Property\PropertyBasicInfoUpdated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Providers\Providers\PropertyDocumentsRepoProvider;
use Intervention\Image\Facades\Image;

class UpdatePropertyBasicInfoInJson extends Listener implements ListenerInterface
{
    private $propertyJsonRepo = null;
    public function __construct()
    {
        $this->propertyJsonRepo = (new PropertiesJsonRepoProvider())->repo();
    }

    public function handle(PropertyBasicInfoUpdated $event)
    {
        $propertyModel = $event->property;
        $propertyJson = $event->propertyJson;
        $propertyJson->slug = $propertyModel->slug;
        $this->propertyJsonRepo->update($propertyJson);
    }
}
