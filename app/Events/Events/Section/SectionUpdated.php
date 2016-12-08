<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/20/2016
 * Time: 12:37 PM
 */

namespace App\Events\Events\Section;


use App\DB\Providers\SQL\Models\FeatureSection;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class SectionUpdated extends Event
{
    use SerializesModels;

    public $featureSection = null;

    public function  __construct(FeatureSection $featureSection)
    {
        $this->featureSection = $featureSection;
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