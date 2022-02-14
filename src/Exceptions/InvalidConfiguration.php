<?php

namespace Shaprk\Sms\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function configurationNotSet()
    {
        return new static('Invalid configuration has been provided.');
    }
}
