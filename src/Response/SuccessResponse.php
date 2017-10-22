<?php

namespace Cronlog\Response;

class SuccessResponse extends Response
{
    public function __construct()
    {
        parent::__construct(200, "ok");
    }
}