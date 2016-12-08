<?php

namespace App\Listeners\Listeners\User;

use App\Events\Events\User\UserCreated;
use App\Libs\Json\Creators\Creators\User\UserJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\UsersJsonRepository;
use Illuminate\Support\Facades\Mail;

class CreateUserJsonDocument extends Listener implements ListenerInterface
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
     * @param  UserCreated  $event
     * @return bool
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $userJsonCreator = new UserJsonCreator($event->user);
        $userJson = $userJsonCreator->create();
        $this->usersJsonRepository->store($userJson);
        return Mail::send('frontend.mail.register_mail',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to($user->email)->subject('Nugree');
        });

    }
}
