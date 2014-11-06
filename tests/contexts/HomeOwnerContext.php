<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Jenko\House\Aggregate\Dimensions;
use Jenko\House\Aggregate\Garden;
use Jenko\House\Aggregate\House;
use Jenko\House\Aggregate\Room;

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
        $kitchen = new Room('kitchen', new Dimensions(300, 100));
        $lounge = new Room('living-room', new Dimensions(400, 300));
        $hallway = new Room('hallway', new Dimensions(300, 800));
        $garden = new Garden('front garden', new Dimensions(600,80));
        $kitchen->setExits([$hallway]);
        $lounge->setExits([$kitchen]);
        $hallway->setExits([$lounge]);
        $garden->setExits([$hallway]);

        $locations =  [$lounge, $kitchen, $hallway, $garden];
        $this->house = House::buildHouse($locations);
    }

    /**
     * @Given there are the following locations in the house
     */
    public function thereAreTheFollowingLocationsInTheHouse(TableNode $table)
    {
        $locations = [];

        foreach ($table->getHash() as $data) {
            if ('garden' === $data['type']) {
                $location = new Garden($data['name'], new Dimensions($data['width'], $data['height']));
            } else {
                $location = new Room($data['name'], new Dimensions($data['width'], $data['height']));
            }

            $locations[] = $location;
        }

        $this->house = House::buildHouse($locations);
    }

    /**
     * @Given I am outside of the house
     */
    public function iAmOutsideOfTheHouse()
    {
        $this->house->resetCurrentLocation();
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
        PHPUnit_Framework_Assert::assertInstanceOf('Jenko\\House\\Aggregate\\Garden', $this->house->whereAmI());
        PHPUnit_Framework_Assert::assertEquals('front garden', $this->house->whereAmI());
    }

    /**
     * @When I request room info
     */
    public function iRequestRoomInfo()
    {
        $this->house->whereAmI()->getInformation();
    }

    /**
     * @Then I should have room size and adjacent rooms
     */
    public function iShouldHaveRoomSizeAndAdjacentRooms()
    {
        $information = $this->house->whereAmI()->getInformation();
        PHPUnit_Framework_Assert::assertArrayHasKey('dimensions', $information);
        PHPUnit_Framework_Assert::assertArrayHasKey('exits', $information);
    }

    /**
     * @Given I am in the hallway
     */
    public function iAmInTheHallway()
    {
        $this->iEnterTheRoom('hallway');
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
        } catch (\Jenko\House\Exception\RoomDoesNotExistException $e) {
            return true;
        }
    }

    /**
     * @Then I should be able to enter the :roomName room
     */
    public function iShouldBeAbleToEnterTheRoom($roomName)
    {
        $this->iEnterTheRoom($roomName);
    }
}
