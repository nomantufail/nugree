<?php

namespace App\Events\Events\User;

use App\DB\Providers\SQL\Models\Role;
use App\Events\Events\Event;
use App\DB\Providers\SQL\Models\User;
use Illuminate\Queue\SerializesModels;

class UserRolesChanged extends Event
{
    use SerializesModels;


    public $userId = null;
    /**
     * @param  $userId
     * Create a new event instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
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
