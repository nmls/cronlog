<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class IntegrationContext implements Context
{

    /** @var array */
    private $parameters = [];

    /** @var string */
    private $curlResponse = "";

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
        $this->parameters = $parameters;
    }

    /**
     * @Then I should get success response
     */
    public function iShouldGetSuccessResponse()
    {
        // @todo: check http status
        if ($this->curlResponse != "ok") {
            throw new Exception();
        }
    }

    /**
     * @Then I should get failure response
     */
    public function iShouldGetFailureResponse()
    {
        // @todo: check http status 
        if ($this->curlResponse != "fail") {
            throw new Exception();
        }
    }

    /**
     * @Given I am on :arg1 and I have the following GET parameter :arg2 with :arg3
     */
    public function iAmOnAndIHaveTheFollowingGetParameterWith($arg1, $arg2, $arg3)
    {
        $this->hitApp($arg1 . "?" . $arg2 . "=" . $arg3);
    }

    /**
     * @Given I am on :arg1 and I do not have any GET parameters
     */
    public function iAmOnAndIDoNotHaveAnyGetParameters($arg1)
    {
        $this->hitApp($arg1);
    }

    /**
     * @param $arg1
     */
    private function hitApp($arg1): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->parameters["base_url"] . $arg1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->curlResponse = curl_exec($ch);
        curl_close($ch);
    }

}
