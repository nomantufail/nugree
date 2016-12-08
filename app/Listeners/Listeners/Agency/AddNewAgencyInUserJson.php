<?php

namespace App\Listeners\Listeners\Agency;

use App\Libs\Json\Creators\Creators\User\AgencyJsonCreator;
use App\Events\Events\Agency\AgencyCreated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class AddNewAgencyInUserJson extends Listener implements ListenerInterface
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
     * @param  AgencyCreated  $event
     * @return bool
     */
    public function handle(AgencyCreated $event)
    {
        $agencyJsonCreator = new AgencyJsonCreator($event->agency);
        $agencyJson = $agencyJsonCreator->create();
        $userJsonObj = $this->usersJsonRepository->find($event->agency->userId);
        array_push($userJsonObj->agencies, $agencyJson);
        return $this->usersJsonRepository->update($userJsonObj);
    }
}
