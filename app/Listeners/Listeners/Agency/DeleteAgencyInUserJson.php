<?php

namespace App\Listeners\Listeners\Agency;

use App\Events\Events\Agency\AgencyDeleted;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class DeleteAgencyInUserJson extends Listener implements ListenerInterface
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
     * @param  AgencyDeleted  $event
     * @return bool
     */
    public function handle(AgencyDeleted $event)
    {
        $userJsonObj = $this->usersJsonRepository->find($event->agency->userId);
        $agencies = $userJsonObj->agencies;
        $finalAgencies = [];
        foreach($agencies as $agency)
        {
            if($event->agency->id != $agency->id)
            {
               $finalAgencies[] = $agency;
            }
       }
        $userJsonObj->agencies = $finalAgencies;
        return $this->usersJsonRepository->update($userJsonObj);
    }
}
