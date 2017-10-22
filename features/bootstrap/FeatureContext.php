<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /** @var \Cronlog\Response\Response */
    private $resp;

    /** @var  \Cronlog\StoreInterface */
    private $store;

    /** @var array */
    private $parameters = [];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->store = \Mockery::mock(\Cronlog\StoreInterface::class);
        $this->parameters = $parameters;
    }

    /**
     * @Given request with uuid :arg1
     */
    public function requestWithUuid($uuid)
    {
        $this->uuid = $uuid;
        $this->runApp($uuid);
    }

    /**
     * @Then exception should be thrown
     */
    public function exceptionShouldBeThrown()
    {
        try {
            $this->runApp($this->uuid);
        } catch (Cronlog\Exception\InvalidUUIDException $e) {
            // test passed
        }
    }

    /**
     * @Then response should be success
     */
    public function responseShouldBeSuccess()
    {
        if (!$this->resp instanceof \Cronlog\Response\SuccessResponse) {
            throw new \Exception();
        }
    }

    /**
     * @Then response should be failure
     */
    public function responseShouldBeFailure()
    {
        if (!$this->resp instanceof \Cronlog\Response\FailureResponse) {
            throw new \Exception();
        }
    }

    private function runApp($uuid)
    {
        $request = new \Cronlog\Request($uuid);
        $this->store->shouldReceive('store')
            ->with($uuid)
            ->andReturn(true);
        $app = new \Cronlog\App($this->store);
        $this->resp = $app->run($request);
    }
}
