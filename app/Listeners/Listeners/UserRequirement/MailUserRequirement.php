<?php

namespace App\Listeners\Listeners\UserRequirement;

use App\Events\Events\UserRequirement\UserRequirements;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;
use Illuminate\Support\Facades\Mail;

class MailUserRequirement extends Listener implements ListenerInterface
{
    private $usersJsonRepository = null;


    public function __construct(UsersJsonRepository $usersJsonRepository)
    {
        $this->usersJsonRepository = $usersJsonRepository;
    }


    public function handle(UserRequirements $event)
    {
        $userRequirement = $event->userRequirement;
        return Mail::send('frontend.mail.user_requirement',['userRequirement' => $userRequirement], function($message) use($userRequirement)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'Nugree');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });

    }
}
