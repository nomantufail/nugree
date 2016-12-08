<?php

namespace App\Events\Events\Agency;

use App\DB\Providers\SQL\Models\Agency;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class AgencyCreated extends Event
{
    use SerializesModels;


    /**
     * @var $agency Agency
     */
    public $agency = null;
    /**
     * @param Agency $agency
     * Create a new event instance.
     */
    public function __construct(Agency $agency)
    {
        $this->agency = $agency;
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
