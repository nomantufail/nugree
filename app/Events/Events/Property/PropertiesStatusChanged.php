<?php

namespace App\Events\Events\Property;

use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\Property;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class PropertiesStatusChanged extends Event
{
    use SerializesModels;

    public $propertyIds = [];
    public $propertyStatusId;

    public function __construct(array $propertyIds , $propertyStatusId)
    {
        $this->propertyIds = $propertyIds;
        $this->propertyStatusId = $propertyStatusId;
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
