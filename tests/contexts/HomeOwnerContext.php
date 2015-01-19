<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Jenko\House\Dimensions;
use Jenko\House\Garden;
use Jenko\House\House;
use Jenko\House\Room;
use Jenko\House\Exception\LocationDoesNotExistException;

class HomeOwnerContext implements Context, SnippetAcceptingContext
{
    private $house;

    public function __construct()
    {
        $frontGarden = Garden::named('front garden');
        $hallway = Room::named('hallway');
        $livingRoom = Room::named('living room');
        $kitchen = Room::named('kitchen');

        $locations = [$frontGarden, $hallway, $livingRoom, $kitchen];
        $this->house = House::build($locations);
    }

    /**
     * @Given I am in the :location
     */
    public function iAmInThe($location)
    {
        $this->iEnterTheRoom($location);
    }

    /**
     * @When I enter through the front door
     */
    public function iEnterThroughTheFrontDoor()
    {
        $this->iEnterTheRoom('hallway');
    }

    /**
     * @Then I should be in the :location
     */
    public function iShouldBeInThe($location)
    {
        $whereAmI = $this->house->whereAmI();
        PHPUnit_Framework_Assert::assertEquals($location, $whereAmI->getName());
    }

    /**
     * @When I request room info
     */
    public function iRequestRoomInfo()
    {
        $this->house->whereAmI()->getInformation();
    }

    /**
     * @Then I should have dimensions and exits
     */
    public function iShouldHaveDimensionsAndExits()
    {
        $information = $this->house->whereAmI()->getInformation();
        PHPUnit_Framework_Assert::assertArrayHasKey('dimensions', $information);
        PHPUnit_Framework_Assert::assertArrayHasKey('exits', $information);
    }

    /**
     * @When I leave through the front door
     */
    public function iLeaveThroughTheFrontDoor()
    {
        $frontGarden = Garden::named('front garden');
        $this->house->exitToRoom($frontGarden);
    }

    /**
     * @Given there are the following locations in the house
     */
    public function thereAreTheFollowingLocationsInTheHouse(TableNode $table)
    {
        $locations = [];

        foreach ($table->getHash() as $data) {
            $dimensions = Dimensions::fromWidthAndHeight($data['width'], $data['height']);

            if ('garden' === $data['type']) {
                $location = Garden::named($data['name']);
                $location->setDimensions($dimensions);
            } else {
                $location = Room::named($data['name']);
                $location->setDimensions($dimensions);
            }

            $locations[] = $location;
        }

        $this->house = House::build($locations);
    }

    /**
     * @Then I should be able to enter the :roomName room
     */
    public function iShouldBeAbleToEnterTheRoom($roomName)
    {
        $this->iEnterTheRoom($roomName);
    }

    /**
     * @When I enter the :roomName room
     */
    public function iEnterTheRoom($roomName)
    {
        $this->house->enterRoom($roomName);
    }

    /**
     * @Then I should not be able to enter the :roomName room
     */
    public function iShouldNotBeAbleToEnterTheRoom($roomName)
    {
        try {
            $this->iEnterTheRoom($roomName);
            throw new \RuntimeException();
        } catch (LocationDoesNotExistException $e) {
            return true;
        }
    }

    /**
     * @Then I should have dimensions :dimensions
     */
    public function iShouldHaveDimensions($dimensions)
    {
        $information = $this->house->whereAmI()->getInformation();

        PHPUnit_Framework_Assert::assertArrayHasKey('dimensions', $information);
        PHPUnit_Framework_Assert::assertEquals($dimensions, $information['dimensions']);
    }

    /**
     * @Then I should have exits
     */
    public function iShouldHaveExits()
    {
        $information = $this->house->whereAmI()->getInformation();
        PHPUnit_Framework_Assert::assertArrayHasKey('exits', $information);
    }

    /**
     * @Then I should know that I came from the :roomName
     */
    public function iShouldKnowThatICameFromThe($roomName)
    {
        PHPUnit_Framework_Assert::assertEquals($this->house->whereWasI()->getName(), $roomName);
    }
}
