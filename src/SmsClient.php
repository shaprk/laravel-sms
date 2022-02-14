<?php

namespace Shaprk\Sms;

use Exception;
use IPPanel\Client;
use Shaprk\Sms\Exceptions\CouldNotSendNotification;

class SmsClient
{
    public function __construct(protected Client $client, protected array $config)
    {
    }

    /**
     * Send the message.
     *
     * @param SmsMessage $message
     * @return mixed|void
     * @throws \Shaprk\Sms\Exceptions\CouldNotSendNotification
     */
    public function send(SmsMessage $message)
    {
        if (empty($message->getOriginator())) {
            $message->from($this->config['originator']);
        }

        try {
            $response = $this->client->sendPattern(
                $message->getPattern(),
                $message->getOriginator(),
                $message->getRecipient(),
                $message->getValues()
            );

            return json_decode($response);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
