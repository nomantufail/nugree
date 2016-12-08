<?php

namespace App\Listeners\Listeners\Agency;

use App\Events\Events\Agency\AgencyUpdated;
use App\Libs\Json\Creators\Creators\User\AgencyJsonCreator;
use App\Events\Events\Agency\AgencyCreated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class UpdateAgencyInUserJson extends Listener implements ListenerInterface
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
     * @param  AgencyUpdated  $event
     * @return bool
     */
    public function handle(AgencyUpdated $event)
    {
        $agencyJsonCreator = new AgencyJsonCreator($event->agency);
        $agencyJson = $agencyJsonCreator->create();
        $userJsonObjects = $this->usersJsonRepository->getAgencyStaff($event->agency->id);
        foreach ($userJsonObjects as $userJsonObj)
        {
            $agencies = $userJsonObj->agencies;
            $agency = null;
            $final_agencies = [];
            foreach ($agencies as $agency)
            {
                if ($event->agency->id == $agency->id)
                {
                    array_push($final_agencies, $agencyJson);
                } else
                {
                    array_push($final_agencies, $agency);
                }
            }
             $userJsonObj->agencies = $final_agencies;
            return $this->usersJsonRepository->update($userJsonObj);
        }
        return true;
    }
}
