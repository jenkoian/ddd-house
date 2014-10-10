<?php

namespace spec\Jenko\House;

use Jenko\House\Location;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\House');
    }

    function it_should_change_location_on_entering_front_door()
    {
        $this->whereAmI()->getName()->shouldBe(Location::DEFAULT_LOCATION);
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
    }

    function it_should_be_able_to_reset_location()
    {
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
        $this->resetLocation();
        $this->whereAmI()->getName()->shouldBe(Location::DEFAULT_LOCATION);
    }

    function it_should_be_possible_to_set_location()
    {
        $location = new Location('kitchen');

        $this->setLocation($location);
        $this->whereAmI()->shouldBe($location);
    }

    function it_should_change_location_on_exiting_the_front_door()
    {
        $location = new Location('hallway');
        $this->setLocation($location);

        $this->exitFrontDoor();
        $this->whereAmI()->getName()->shouldBe(Location::DEFAULT_LOCATION);
    }
}
