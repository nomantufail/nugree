<?php

namespace App\Events\Events\UserRequirement;

use App\DB\Providers\SQL\Models\UserRequirement;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserRequirements extends Event
{
    use SerializesModels;

    public $userRequirement = null;
    /**
     * @param $userRequirement
     * Create a new event instance.
     */
    public function __construct(UserRequirement $userRequirement)
    {
        $this->userRequirement = $userRequirement;
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
