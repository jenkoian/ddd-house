<?php

namespace spec\Jenko\House;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('named', ['hallway']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Room');
    }

    function it_should_be_created_with_a_name()
    {
        $garden = self::named('living room');
        $garden->shouldHaveType('Jenko\House\Room');
        $garden->getName()->shouldEqual('living room');
    }

    function it_should_give_an_array_of_information()
    {
        $this->getInformation()->shouldBeArray();
    }
}
