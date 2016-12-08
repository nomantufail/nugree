<?php

namespace App\Listeners\Listeners\Agency;

use App\Events\Events\Agency\AgencyUpdated;

use App\Libs\Json\Creators\Creators\User\AgencyJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertiesJsonRepoProvider;
use App\Repositories\Repositories\Sql\UsersJsonRepository;

class UpdateAgencyInPropertiesJson extends Listener implements ListenerInterface
{
    private $usersJsonRepository = null;
    public $properties = null;
    /**
     * @param UsersJsonRepository $usersJsonRepository
     * Create the event listener.
     */
    public function __construct(UsersJsonRepository $usersJsonRepository)
    {
        $this->usersJsonRepository = $usersJsonRepository;
        $this->properties = (new PropertiesJsonRepoProvider())->repo();
    }

    /**
     * Handle the event.
     *
     * @param  AgencyUpdated  $event
     * @return bool
     */
    public function handle(AgencyUpdated $event)
    {
        $propertiesJson = $this->properties->getAgencyProperties($event->agency->id);
        $finalResult = [];
        foreach ($propertiesJson as $property)
        {
            $property->owner->agency = (new AgencyJsonCreator($event->agency))->create();
            $finalResult[] = $property;
        }
        $this->properties->updateMultipleByIds($finalResult);
        return true;
    }

}
