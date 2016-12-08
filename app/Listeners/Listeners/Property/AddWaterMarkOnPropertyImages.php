<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertyCreated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertyDocumentsRepoProvider;
use Intervention\Image\Facades\Image;

class AddWaterMarkOnPropertyImages extends Listener implements ListenerInterface
{
    private $propertyDocument="";
    public function __construct()
    {
        $this->propertyDocument = (new PropertyDocumentsRepoProvider())->repo();
    }

    public function handle(PropertyCreated $event)
    {
        $property = $event->property;
        $propertyImages = $this->propertyDocument->getByProperty($property->id);

        foreach ($propertyImages as $propertyImage)
        {
            $image =Image::make(storage_path().'/app/'.$propertyImage->path);

            $waterMarkeImage = Image::make(url('/').'/assets/imgs/water2.png');
            $image->insert($waterMarkeImage,'center');

            $secondWaterMarkeImage = Image::make(url('/').'/assets/imgs/water.png');
            $image->insert($secondWaterMarkeImage,'bottom-right', 2, 2);

            $image->save(storage_path().'/app/'.$propertyImage->path);
        }
        return;
    }
}
