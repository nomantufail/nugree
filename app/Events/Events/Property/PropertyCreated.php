<?php

namespace App\Events\Events\Property;

use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\Property;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class PropertyCreated extends Event
{
    use SerializesModels;


    /**
     * @var $property Property
     */
    public $property = null;
    /**
     * @param Property $property
     * Create a new event instance.
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
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
