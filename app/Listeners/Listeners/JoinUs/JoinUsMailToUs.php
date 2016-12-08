<?php

namespace App\Listeners\Listeners\JoinUs;

use App\Events\Events\JoinUs\JoinUsMail;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use Illuminate\Support\Facades\Mail;

class JoinUsMailToUs extends Listener implements ListenerInterface
{
    public function __construct()
    {

    }


    public function handle(JoinUsMail $event)
    {
        $userRequirement = $event->joinUs;
        return Mail::send('frontend.mail.joinUs',['userRequirement' => $userRequirement], function($message) use($userRequirement)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Nugree');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });

    }
}
