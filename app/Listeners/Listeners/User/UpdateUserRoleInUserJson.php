<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UserRolesChanged;
use App\Libs\Json\Creators\Creators\Role\RolesJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;

class UpdateUserRoleInUserJson extends Listener implements ListenerInterface
{
    private $roles = null;
    private $userJson = null;
    /**
     * @param RolesRepoProvider $rolesRepoProvider
     * Create the event listener.
     */
    public function __construct(RolesRepoProvider $rolesRepoProvider)
    {
        $this->roles = $rolesRepoProvider->repo();
        $this->userJson = (new UsersJsonRepoProvider())->repo();

    }

    /**
     * Handle the event.
     *
     * @param  UserRolesChanged  $event
     * @return void
     */
    public function handle(UserRolesChanged $event)
    {
        $roles = $this->roles->getUserRoles($event->userId);

        $finalRecords = [];
        foreach($roles as $role)
        {
            $finalRecords[] = (new RolesJsonCreator($role))->create();
        }
        $userJson = $this->userJson->find($event->userId);
        $userJson->roles = $finalRecords;
        $this->userJson->update($userJson);
    }
}
