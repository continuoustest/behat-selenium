<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \Behat\MinkExtension\Context\MinkContext implements Context
{
    protected $headers = [
        'Content-type: text/plain',
    ];

    protected $curlResponse;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Then I wait during :arg1 ms
     */
    public function iWaitDuringMs($arg1)
    {
        $this->getSession()->wait($arg1);
    }

    /**
     * @Given header :arg1 with :arg2
     */
    public function aHeaderWith($arg1, $arg2)
    {
        $this->headers[] = "$arg1: $arg2";
    }

    /**
     * @When I send request to :arg1
     */
    public function iSendRequestTo($arg1)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->locatePath($arg1));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $this->curlResponse = curl_exec($ch);

        curl_close($ch);
    }

    /**
     * @Then response should be :arg1
     */
    public function responseShouldBe($arg1)
    {
        if ($this->curlResponse !== $arg1) {
            echo $this->curlResponse;
            throw new AssertionError('Curl response error');
        }
    }
}
