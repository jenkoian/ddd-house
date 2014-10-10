<?php

namespace spec\Jenko\House;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Location');
    }
}
