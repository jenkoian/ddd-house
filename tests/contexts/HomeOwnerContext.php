<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Jenko\House\Garden;
use Jenko\House\House;
use Jenko\House\Room;

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
        if (false !== strpos('garden', $location)) {
            $location = Room::named($location);
        } else {
            $location = Garden::named($location);
        }

        $this->house->setLocation($location);
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
        PHPUnit_Framework_Assert::assertEquals(Room::named($location), $whereAmI);
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
        $this->house->exitRoom($frontGarden);
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

        $this->house = House::buildHouse($locations);
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
        $room = Room::named($roomName);
        $this->house->enterRoom($room);
    }

    /**
     * @Then I should not be able to enter the :roomName room
     */
    public function iShouldNotBeAbleToEnterTheRoom($roomName)
    {
        try {
            $this->iEnterTheRoom($roomName);
        } catch (RoomDoesNotExistException $e) {
            return true;
        }
    }
}
