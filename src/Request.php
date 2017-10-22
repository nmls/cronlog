<?php

namespace Cronlog;

class Request
{

    private $uuid;

    public function __construct(string $UUID)
    {
        $this->uuid = $UUID;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return (bool)preg_match('/^[a-zA-Z0-9]{1,120}$/', $this->uuid);
    }

}