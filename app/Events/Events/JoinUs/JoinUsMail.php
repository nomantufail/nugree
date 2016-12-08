<?php

namespace App\Events\Events\JoinUs;

use App\DB\Providers\SQL\Models\JoinUs;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class JoinUsMail extends Event
{
    use SerializesModels;

    public $joinUs = null;
    /**
     * @param $joinUs
     * Create a new event instance.
     */
    public function __construct(JoinUs $joinUs)
    {
        $this->joinUs = $joinUs;
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
