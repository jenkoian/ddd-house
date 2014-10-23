<?php

namespace spec\Jenko\House\Aggregate;

use Jenko\House\Aggregate\Garden;
use Jenko\House\Aggregate\Room;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseSpec extends ObjectBehavior
{
    function let()
    {
        // TODO: extract this out to re-usable method
        $kitchen = new Room('kitchen');
        $hallway = new Room('hallway');
        $garden = new Garden('front garden');
        $kitchen->setInformation(['size' => '300 x 300', 'rooms' => []]);
        $hallway->setInformation(['size' => '300 x 300', 'rooms' => [$kitchen]]);
        $garden->setInformation(['size' => '300 x 300', 'rooms' => [$hallway]]);

        $locations =  [$kitchen, $hallway, $garden];

        $this->beConstructedThrough('buildHouse', [$locations]);
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
        $room = new Room('kitchen');

        $this->enterRoom($room);
        $this->whereAmI()->shouldBe($room);
    }

    function it_should_change_location_on_exiting_the_front_door()
    {
        $room = new Room('hallway');
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
        $kitchen = new Room('kitchen');
        $hallway = new Room('hallway');
        $garden = new Garden('front garden');
        $kitchen->setInformation(['size' => '300 x 300', 'rooms' => []]);
        $hallway->setInformation(['size' => '300 x 300', 'rooms' => [$kitchen]]);
        $garden->setInformation(['size' => '300 x 300', 'rooms' => [$hallway]]);

        $locations =  [$kitchen, $hallway, $garden];

        $this->getLocations()->shouldBeArray();
        $this->getLocations()->shouldHaveCount(count($locations));
        $this->getLocations()->shouldBeLike($locations);
    }

    function it_should_throw_exception_if_attempting_to_enter_invalid_room()
    {
        $madeUpRoom = new Room('totally made up');
        $this->shouldThrow('\Jenko\House\Exception\RoomDoesNotExistException')->during('enterRoom', [$madeUpRoom]);
    }
}
