<?php

namespace Shaprk\Sms;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Notification;
use Shaprk\Sms\Exceptions\CouldNotSendNotification;

class SmsChannel
{
    public function __construct(protected SmsClient $client, private ?Dispatcher $dispatcher = null)
    {
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return mixed
     * @throws Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toPatternSms($notifiable);

        $data = [];

        if (is_string($message)) {
            $message = new SmsMessage;
        }

        if ($to = $notifiable->routeNotificationFor('laravel-sms')) {
            $message->to($to);
        }

        try {
            $data = $this->client->send($message);
            $this->dispatcher?->dispatch('laravel-sms', [$notifiable, $notification, $data]);
        } catch (CouldNotSendNotification $exception) {
            $this->dispatcher->dispatch(
                new NotificationFailed($notifiable, $notification, 'laravel-sms', $exception->getMessage())
            );
        }

        return $data;
    }
}
