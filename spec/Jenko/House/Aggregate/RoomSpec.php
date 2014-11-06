<?php

namespace spec\Jenko\House\Aggregate;

use Jenko\House\Aggregate\Dimensions;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('hallway', new Dimensions(100, 100));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Aggregate\Room');
    }

    function it_is_a_location()
    {
        $this->shouldHaveType('Jenko\House\Aggregate\Location');
    }
}
