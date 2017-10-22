<?php

include_once __DIR__ . '/vendor/autoload.php';

use Cronlog\App;
use Cronlog\Request;
use Cronlog\Response\FailureResponse;
use Cronlog\StoreInterface;

function prepareRequest(array $data = []): Request
{
    if (!array_key_exists("uuid", $data)) {
        (new FailureResponse())->render();
        die;
    }

    return new Request($data["uuid"]);
}

$request = prepareRequest($_GET);

/** @var StoreInterface $store */
$store = \Mockery::mock(StoreInterface::class)
    ->shouldReceive('store')
    ->getMock();

(new App($store))->run($request)->render();
