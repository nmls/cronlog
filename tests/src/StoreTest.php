<?php

include_once __DIR__ . '/../../vendor/autoload.php';

class StoreTest extends \PHPUnit\Framework\TestCase
{
    /** @var \Cronlog\Store */
    private $SUT;

    public function setUp()
    {

        $this->SUT = new \Cronlog\Store();
    }

    public function testSave()
    {
        $line = "gffdsgfdsgfdsg";

        $this->SUT->store($line);

        $this->assertTrue($this->SUT->data[0] === $line);
    }
}