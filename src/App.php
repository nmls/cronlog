<?php

namespace Cronlog;

use Cronlog\Response\FailureResponse;
use Cronlog\Response\Response;
use Cronlog\Response\SuccessResponse;

class App
{
    private $store;

    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
    }

    public function run(Request $request): Response
    {
        if (!$request->validate()) {
            return new FailureResponse();
        }

        $l = $request->getUuid();
        $this->store->store($l);

        return new SuccessResponse();
    }
}