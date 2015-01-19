<?php

namespace spec\Jenko\House;

use Jenko\House\Dimensions;
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
    }

    function it_should_be_created_with_a_name()
    {
        $garden = self::named('front garden');
        $garden->shouldHaveType('Jenko\House\Garden');
        $garden->getName()->shouldEqual('front garden');
    }

    function it_should_give_information()
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
