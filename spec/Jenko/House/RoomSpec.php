<?php

namespace spec\Jenko\House;

use Jenko\House\Dimensions;
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
        $this->shouldHaveType('Jenko\House\Location');
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

    function it_should_be_able_to_set_dimensions()
    {
        $dimensions = Dimensions::fromWidthAndHeight(350, 300);
        $this->setDimensions($dimensions);

        $this->getDimensions()->shouldEqual($dimensions);
    }
}
