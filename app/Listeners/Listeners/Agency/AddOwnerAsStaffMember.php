<?php

namespace App\Listeners\Listeners\Agency;

use App\DB\Providers\SQL\Models\AgencyStaff;
use App\Events\Events\Agency\AgencyCreated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\AgencyStaffRepoProvider;

class AddOwnerAsStaffMember extends Listener implements ListenerInterface
{
    private $agencyStaffRepository = null;

    /**
     * @param AgencyStaffRepoProvider $agencyStaffProvider
     * Create the event listener.
     */
    public function __construct(AgencyStaffRepoProvider $agencyStaffProvider)
    {
        $this->agencyStaffRepository = $agencyStaffProvider->repo();
    }

    /**
     * Handle the event.
     *
     * @param  AgencyCreated  $event
     * @return bool
     */
    public function handle(AgencyCreated $event)
    {
        $agencyStaff =  new AgencyStaff();
        $agencyStaff->agencyId = $event->agency->id;
        $agencyStaff->userId = $event->agency->userId;
        $this->agencyStaffRepository->store($agencyStaff);

    }
}
