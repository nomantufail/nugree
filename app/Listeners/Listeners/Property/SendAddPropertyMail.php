<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\PropertyCreated;
use App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;
use Illuminate\Support\Facades\Mail;

class SendAddPropertyMail extends Listener implements ListenerInterface
{
    public function __construct()
    {

    }

    public function handle(PropertyCreated $event)
    {
        $property = $event->property;
        return Mail::send('frontend.mail.add_property',['property' => $property], function($message) use($property)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to($property->email)->subject('Nugree');
        });
    }
}
