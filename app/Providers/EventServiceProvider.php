<?php

namespace App\Providers;

use App\Events\Events\Agency\AgencyCreated;
use App\Events\Events\Agency\AgencyDeleted;
use App\Events\Events\Agency\AgencyUpdated;
use App\Events\Events\Feature\FeatureJsonCreated;
use App\Events\Events\JoinUs\JoinUsMail;
use App\Events\Events\Property\PropertiesStatusChanged;
use App\Events\Events\Property\PropertyCreated;
use App\Events\Events\Property\PropertyDeleted;
use App\Events\Events\Property\PropertyDEVerified;
use App\Events\Events\Property\PropertyStatusUpdated;
use App\Events\Events\Property\PropertyBasicInfoUpdated;
use App\Events\Events\Property\PropertyUpdated;
use App\Events\Events\Property\PropertyVerified;
use App\Events\Events\Property\UpdatePropertyTotalView;
use App\Events\Events\Section\SectionUpdated;
use App\Events\Events\User\UpdateAgentStatus;
use App\Events\Events\User\UserBasicInfoUpdated;
use App\Events\Events\User\UserCreated;
use App\Events\Events\User\UserRolesChanged;
use App\Events\Events\User\UserUpdated;
use App\Events\Events\UserRequirement\UserRequirements;
use App\Listeners\Listeners\Agency\AddNewAgencyInUserJson;
use App\Listeners\Listeners\Agency\AddOwnerAsStaffMember;
use App\Listeners\Listeners\Agency\DeleteAgencyInUserJson;
use App\Listeners\Listeners\Agency\UpdateAgencyInPropertiesJson;
use App\Listeners\Listeners\Agency\UpdateAgencyInUserJson;
use App\Listeners\Listeners\Feature\CreateFeatureJsonDocument;
use App\Listeners\Listeners\JoinUs\JoinUsMailToUs;
use App\Listeners\Listeners\Property\AddWaterMarkOnPropertyImages;
use App\Listeners\Listeners\Property\CreatePropertyJsonDocument;
use App\Listeners\Listeners\Property\DeletePropertyJsonDocument;
use App\Listeners\Listeners\Property\PropertyDEVerifyInPropertyJson;
use App\Listeners\Listeners\Property\PropertyVerifyInPropertyJson;
use App\Listeners\Listeners\Property\SendAddPropertyMail;
use App\Listeners\Listeners\Property\UpdatePropertiesStatusInJson;
use App\Listeners\Listeners\Property\UpdatePropertyBasicInfoInJson;
use App\Listeners\Listeners\Property\UpdatePropertyJsonDocument;
use App\Listeners\Listeners\Property\UpdatePropertyViewsInPropertyJson;
use App\Listeners\Listeners\Property\UpdateStatusInPropertyJson;
use App\Listeners\Listeners\Section\RegenerateSectionFeaturesJson;
use App\Listeners\Listeners\UserRequirement\MailUserRequirement;
use App\Listeners\Listeners\User\UpdateAgentStatusInUserJson;
use App\Listeners\Listeners\User\UpdateUserBasicInfoJsonDocument;
use App\Listeners\Listeners\User\CreateUserJsonDocument;
use App\Listeners\Listeners\User\UpdateUserJson;
use App\Listeners\Listeners\User\UpdateUserRoleInUserJson;
use App\Traits\AssignedFeaturesJsonDocumentsGenerator;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreated::class=> [
            CreateUserJsonDocument::class,
        ],
        JoinUsMail::class=> [
            JoinUsMailToUs::class,
        ],
        UserBasicInfoUpdated::class => [
            UpdateUserBasicInfoJsonDocument::class
        ],
        UserUpdated::class => [
            UpdateUserJson::class
        ],

        /* agency events */
        AgencyCreated::class => [
            AddNewAgencyInUserJson::class,
            AddOwnerAsStaffMember::class
        ],
        AgencyUpdated::class => [
            UpdateAgencyInUserJson::class,
            UpdateAgencyInPropertiesJson::Class,
        ],
        AgencyDeleted::class => [
            DeleteAgencyInUserJson::class,
        ],
        UserRequirements::class => [
            MailUserRequirement::class,
        ],
        /* property events */
        PropertyCreated::class => [
            CreatePropertyJsonDocument::class,
            AddWaterMarkOnPropertyImages::class,
            //SendAddPropertyMail::class
        ],
        PropertyUpdated::class => [
            UpdatePropertyJsonDocument::class,
        ],
        PropertyBasicInfoUpdated::class => [
            UpdatePropertyBasicInfoInJson::class,
        ],
        UpdatePropertyTotalView::class => [
            UpdatePropertyViewsInPropertyJson::class,
        ],
        PropertyVerified::class => [
            PropertyVerifyInPropertyJson::class,
        ],
        PropertyDEVerified::class => [
            PropertyDEVerifyInPropertyJson::class,
        ],
        PropertyDeleted::class => [
            DeletePropertyJsonDocument::class,
        ],
        PropertiesStatusChanged::class => [
            UpdatePropertiesStatusInJson::class,
        ],
        FeatureJsonCreated::class => [
            CreateFeatureJsonDocument::class,
        ],
        SectionUpdated::class => [
            RegenerateSectionFeaturesJson::class,
        ],
        UpdateAgentStatus::class => [
            UpdateAgentStatusInUserJson::class,
        ],
        UserRolesChanged::class => [
            UpdateUserRoleInUserJson::class,
        ],
        PropertyStatusUpdated::class => [
            UpdateStatusInPropertyJson::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
