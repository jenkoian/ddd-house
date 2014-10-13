<?php

namespace spec\Jenko\House\Aggregate;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GardenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Aggregate\Garden');
    }

    function it_is_a_location()
    {
        $this->shouldHaveType('Jenko\House\Aggregate\Location');
    }
}
