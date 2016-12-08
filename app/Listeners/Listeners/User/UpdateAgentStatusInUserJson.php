<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UpdateAgentStatus;
use App\Libs\Json\Creators\Creators\User\UserJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class UpdateAgentStatusInUserJson extends Listener implements ListenerInterface
{
    private $usersJsonRepository = null;

    /**
     * @param UsersJsonRepository $usersJsonRepository
     * Create the event listener.
     */
    public function __construct(UsersJsonRepository $usersJsonRepository)
    {
        $this->usersJsonRepository = $usersJsonRepository;
    }
    public function handle(UpdateAgentStatus $event)
    {
        $userJson = $this->usersJsonRepository->find($event->user->id);
        $userJson->trustedAgent = $event->user->trustedAgent;
        $this->usersJsonRepository->update($userJson);
    }
}
