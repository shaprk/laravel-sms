<?php

namespace Shaprk\Sms;

class SmsMessage
{
    /**
     * The phone number to be used as sender of messages.
     *
     * @var string
     */
    protected $originator;

    /**
     * The recipient number of the message.
     *
     * @var
     */
    protected $recipient;

    /**
     * Message pattern that is registered in provider api.
     *
     * @var string
     */
    protected $pattern;

    /**
     * Message pattern values.
     *
     * @var array
     */
    protected $values;

    /**
     * Message originator getter.
     *
     * @return string
     */
    public function getOriginator()
    {
        return $this->originator;
    }

    /**
     * Message recipient getter.
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Message pattern getter.
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Message pattern values getter.
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Customize originator default value.
     *
     * @param $originator
     * @return $this
     */
    public function from($originator)
    {
        $this->originator = $originator;
        return $this;
    }

    /**
     * Set recipient number value.
     *
     * @param string $recipient
     * @return $this
     */
    public function to($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Set the pattern.
     *
     * @param $pattern
     * @return $this
     */
    public function pattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Set pattern values.
     *
     * @param $values
     * @return $this
     */
    public function withValues($values)
    {
        $this->values = $values;
        return $this;
    }
}
