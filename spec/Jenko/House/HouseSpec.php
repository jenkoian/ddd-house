<?php

namespace spec\Jenko\House;

use Jenko\House\Room;
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
        $this->whereAmI()->getName()->shouldBe('front garden');
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
    }

    function it_should_be_able_to_reset_location()
    {
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
        $this->resetLocation();
        $this->whereAmI()->getName()->shouldBe('front garden');
    }

    function it_should_be_possible_to_set_room()
    {
        $location = new Room('kitchen');

        $this->setLocation($location);
        $this->whereAmI()->shouldBe($location);
    }

    function it_should_change_location_on_exiting_the_front_door()
    {
        $location = new Room('hallway');
        $this->setLocation($location);

        $this->exitFrontDoor();
        $this->whereAmI()->getName()->shouldBe('front garden');
    }
}
