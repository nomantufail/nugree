<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/20/2016
 * Time: 12:51 PM
 */

namespace App\Listeners\Listeners\Section;


use App\Events\Events\Section\SectionUpdated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\AssignedFeaturesJsonRepository;
use App\Traits\AssignedFeaturesJsonDocumentsGenerator;

class RegenerateSectionFeaturesJson extends Listener implements  ListenerInterface
{
    use AssignedFeaturesJsonDocumentsGenerator;
    private $assignedFeaturesJsonRepository = null;

    /**
     * @param AssignedFeaturesJsonRepository $assignedFeaturesJsonRepository
     */
    public function __construct(AssignedFeaturesJsonRepository $assignedFeaturesJsonRepository)
    {
       $this->assignedFeaturesJsonRepository = $assignedFeaturesJsonRepository;
    }

    /**
     * Handle the event.
     * @param  SectionUpdated  $event
     * @return bool
     */
    public function handle(SectionUpdated $event)
    {
        $section = $event->featureSection;
        $subTypeIds = [1,2,3];
        return  $assignedFeaturesJson = $this->generate($subTypeIds);
    }
}