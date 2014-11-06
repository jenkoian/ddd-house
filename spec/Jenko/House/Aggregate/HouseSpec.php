<?php

namespace spec\Jenko\House\Aggregate;

use Jenko\House\Aggregate\Dimensions;
use Jenko\House\Aggregate\Garden;
use Jenko\House\Aggregate\Room;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('buildHouse', [$this->createLocations()]);
    }

    function createLocations()
    {
        $kitchen = new Room('kitchen', new Dimensions(300,300));
        $hallway = new Room('hallway', new Dimensions(300,300));
        $garden = new Garden('front garden', new Dimensions(300,300));
        $kitchen->setExits([]);
        $hallway->setExits([$kitchen]);
        $garden->setExits([$hallway]);

        return  [$kitchen, $hallway, $garden];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Aggregate\House');
    }

    function it_should_change_location_on_entering_front_door()
    {
        $this->whereAmI()->getName()->shouldBe('front garden');
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
    }

    function it_should_be_able_to_reset_current_location()
    {
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
        $this->resetCurrentLocation();
        $this->whereAmI()->getName()->shouldBe('front garden');
    }

    function it_should_be_possible_to_enter_a_room()
    {
        $room = new Room('kitchen', new Dimensions(300, 300), []);

        $this->enterRoom($room);
        $this->whereAmI()->equals($room)->shouldBe(true);
    }

    function it_should_change_location_on_exiting_the_front_door()
    {
        $room = new Room('hallway', new Dimensions(300, 300));
        $this->enterRoom($room);

        $this->exitFrontDoor();
        $this->whereAmI()->getName()->shouldBe('front garden');
    }

    function it_should_give_information_about_the_current_room()
    {
        $this->enterFrontDoor();
        $this->whereAmI()->getInformation()->shouldBeArray();
    }

    function it_has_locations()
    {
        $locations =  $this->createLocations();

        $this->getLocations()->shouldBeArray();
        $this->getLocations()->shouldHaveCount(count($locations));
        $this->getLocations()->shouldBeLike($locations);
    }

    function it_should_throw_exception_if_attempting_to_enter_invalid_room()
    {
        $madeUpRoom = new Room('totally made up', new Dimensions(1,1));
        $this->shouldThrow('\Jenko\House\Exception\RoomDoesNotExistException')->during('enterRoom', [$madeUpRoom]);
    }
}
