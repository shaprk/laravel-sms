<?php

namespace Shaprk\Sms\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    public static function serviceRespondedWithAnError(Exception $exception)
    {
        return new static(
            "Sms Provider service responded with an error '{$exception->getCode()}: {$exception->getMessage()}'"
        );
    }
}
