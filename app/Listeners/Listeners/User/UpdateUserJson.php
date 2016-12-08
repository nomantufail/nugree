<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UserBasicInfoUpdated;
use App\Events\Events\User\UserUpdated;
use App\Libs\Json\Creators\Creators\User\UserJsonCreator;
use App\DB\Providers\SQL\Models\User;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class UpdateUserJson extends Listener implements ListenerInterface
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

    /**
     * Handle the event.
     *
     * @param  UserUpdated  $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        $jsonCreator = new UserJsonCreator($event->user);
        $userJson = $jsonCreator->create();
        $this->usersJsonRepository->update($userJson);
    }

    public function map(User $userObject)
    {
        $updatedJson = (new UserJsonCreator($userObject))->create();
        return $this->usersJsonRepository->update($updatedJson);
    }
}
