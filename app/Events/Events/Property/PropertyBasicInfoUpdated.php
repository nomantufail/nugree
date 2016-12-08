<?php

namespace App\Events\Events\Property;

use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\Property;
use App\Events\Events\Event;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use Illuminate\Queue\SerializesModels;

class PropertyBasicInfoUpdated extends Event
{
    use SerializesModels;


    /**
     * @var $property Property
     */
    public $property = null;
    public $propertyJson = null;

    /**
     * @param Property $property
     * @param PropertyJsonPrototype|null $propertyJson
     */
    public function __construct(Property $property, PropertyJsonPrototype $propertyJson = null)
    {
        $this->property = $property;
        $this->propertyJson = $propertyJson;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
