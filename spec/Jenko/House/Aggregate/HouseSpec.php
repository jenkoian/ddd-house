<?php

namespace spec\Jenko\House\Aggregate;

use Jenko\House\Aggregate\Room;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HouseSpec extends ObjectBehavior
{
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

    function it_should_be_able_to_reset_location()
    {
        $this->enterFrontDoor();
        $this->whereAmI()->getName()->shouldBe('hallway');
        $this->resetLocation();
        $this->whereAmI()->getName()->shouldBe('front garden');
    }

    function it_should_be_possible_to_enter_a_room()
    {
        $room = new Room('kithen');

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
}
