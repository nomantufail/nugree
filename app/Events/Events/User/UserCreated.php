<?php

namespace App\Events\Events\User;

use App\Events\Events\Event;
use App\DB\Providers\SQL\Models\User;
use App\Repositories\Repositories\Sql\UsersRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCreated extends Event
{
    use SerializesModels;


    /**
     * @var $user User
     */
    public $user = null;
    /**
     * @param User $user
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
