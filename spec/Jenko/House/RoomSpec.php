<?php

namespace spec\Jenko\House;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Room');
    }

    function it_is_a_location()
    {
        $this->shouldHaveType('Jenko\House\Location');
    }
}
