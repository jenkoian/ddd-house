<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Jenko\House\House;
use Jenko\House\Location;

/**
 * Defines application features from the specific context.
 */
class HomeOwnerContext implements Context, SnippetAcceptingContext
{
    private $house;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->house = new House();
    }

    /**
     * @Given I am outside of the house
     */
    public function iAmOutsideOfTheHouse()
    {
        $this->house->resetLocation();
    }

    /**
     * @When I enter through the front door
     */
    public function iEnterThroughTheFrontDoor()
    {
        $this->house->enterFrontDoor();
    }

    /**
     * @Then I should be in the hallway
     */
    public function iShouldBeInTheHallway()
    {
        PHPUnit_Framework_Assert::assertEquals('hallway', $this->house->whereAmI());
    }

    /**
     * @Given I am in the hallway
     */
    public function iAmInTheHallway()
    {
        $this->house->setLocation(new Location('hallway'));
    }

    /**
     * @When I leave through the front door
     */
    public function iLeaveThroughTheFrontDoor()
    {
        $this->house->exitFrontDoor();
    }

    /**
     * @Then I should be outside
     */
    public function iShouldBeOutside()
    {
        PHPUnit_Framework_Assert::assertEquals(Location::DEFAULT_LOCATION, $this->house->whereAmI());
    }
}