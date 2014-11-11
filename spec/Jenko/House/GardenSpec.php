<?php

namespace spec\Jenko\House;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GardenSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('named', ['front garden']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Garden');
        $this->shouldHaveType('Jenko\House\Location');
    }

    function it_should_be_created_with_a_name()
    {
        $garden = self::named('front garden');
        $garden->shouldHaveType('Jenko\House\Garden');
        $garden->getName()->shouldEqual('front garden');
    }
}
