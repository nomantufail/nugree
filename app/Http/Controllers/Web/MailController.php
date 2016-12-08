<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Mail\AgentMailRequest;
use App\Http\Requests\Requests\Mail\ContactUSMailRequest;
use App\Http\Requests\Requests\Mail\FeedbackRequest;
use App\Http\Requests\Requests\Mail\MailPropertyToFriendRequest;
use App\Http\Requests\Requests\Mail\MailToAgentRequest;
use App\Http\Requests\Requests\Mail\WantedMailRequest;
use App\Repositories\Providers\Providers\MailRepoProvider;
use App\Traits\User\UsersFilesReleaser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    use UsersFilesReleaser;
    public $userTransformer = null;
    public $usersJsonRepo = null;
    public $mailRepo = null;
    public function __construct()
    {
        $this->mailRepo = (new MailRepoProvider())->repo();
    }

    public function mailToFriend(MailPropertyToFriendRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.mail_property_to_friend',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }

    public function mailToAgent(MailToAgentRequest $request)
    {
        $user = $request->all();
        $this->mailRepo->storeContactUsMail($user);
        Mail::send('frontend.mail.mail_property_to_agent',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }

    public function feedback(FeedbackRequest $request)
    {
        $user = $request->all();
        $this->mailRepo->storeContactUsMail($user);
        Mail::send('frontend.mail.feedback',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function propertyWanted(WantedMailRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.wanted_requirement',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function contactUS(ContactUSMailRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.contact_us',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });
        Session::flash('message', 'Your message has been sent');
        return redirect()->back();
    }
    public function mailAgent(AgentMailRequest $request)
    {
        $user = $request->all();
        Mail::send('frontend.mail.agent_mail',['user' => $user], function($message) use($user)
        {
            $message->from(config('constants.REGISTRATION_EMAIL_FROM'),'nugree.com');
            $message->to(config('constants.REGISTRATION_EMAIL_TO'))->subject('Nugree');
        });

        return redirect()->back();
    }
}
