<?php

namespace App\Events\Events\Agency;

use App\DB\Providers\SQL\Models\Agency;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class AgencySocietiesUpdated extends Event
{
    use SerializesModels;


    /**
     * @var $agency Agency
     */
    public $agencyId = null;
    public function __construct($agencyId)
    {
        $this->agencyId = $agencyId;
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
