<?php

namespace spec\Jenko\House;

use Jenko\House\Garden;
use Jenko\House\Room;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('build', [$this->createLocations()]);
    }

    function createLocations()
    {
        $frontGarden = Garden::named('front garden');
        $hallway = Room::named('hallway');
        $livingRoom = Room::named('living room');
        $kitchen = Room::named('kitchen');

        return  [$frontGarden, $hallway, $livingRoom, $kitchen];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\House');
    }

    function it_should_build_with_locations()
    {
        $locations = $this->createLocations();
        $house = self::build($locations);

        $house->shouldHaveType('Jenko\House\House');
        $house->getLocations()->shouldEqual($locations);
    }

    function it_should_set_location()
    {
        $location = Room::named('living room');
        $this->setLocation($location);

        $this->whereAmI()->shouldBe($location);
    }

    function it_should_allow_entering_rooms()
    {
        $room = Room::named('kitchen');
        $this->enterRoom($room);
        $this->whereAmI()->shouldBe($room);

        $this->enterRoom('living room');
        $this->whereAmI()->getName()->shouldBe('living room');
    }
}
