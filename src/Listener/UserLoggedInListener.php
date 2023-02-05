<?php

namespace Nearata\LoginNotification\Listener;

use Flarum\Mail\Job\SendRawEmailJob;
use Flarum\User\Event\LoggedIn;
use Illuminate\Contracts\Queue\Queue;
use Jenssegers\Agent\Agent;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserLoggedInListener
{
    protected $queue;
    protected $translator;

    public function __construct(Queue $queue, TranslatorInterface $translator)
    {
        $this->queue = $queue;
        $this->translator = $translator;
    }

    public function handle(LoggedIn $event)
    {
        $user = $event->user;

        if (!$user->getPreference('nearataLoginNotification')) {
            return;
        }

        $token = $event->token;

        $agent = new Agent();

        $notDevice = $this->translator->trans('nearata-login-notification.email.device_not_available');
        $body = $this->translator->trans('nearata-login-notification.email.body', [
            'user_display_name' => $user->display_name,
            'user_email' => $user->email,
            'ip_address' => $token->last_ip_address,
            'datetime' => $token->created_at . ' ' . $token->created_at->tzName,
            'device' => $agent->isMobile() ? $agent->device() : $notDevice,
            'platform' => $agent->platform(),
            'browser' => $agent->browser()
        ]);

        $subject = $this->translator->trans('nearata-login-notification.email.subject');

        $this->queue->push(new SendRawEmailJob($user->email, $subject, $body));
    }
}
