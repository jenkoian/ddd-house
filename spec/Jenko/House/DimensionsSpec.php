<?php

namespace spec\Jenko\House;

use Jenko\House\Dimensions;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DimensionsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromWidthAndHeight', [300, 300]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Dimensions');
    }

    function it_should_be_created_with_a_width_and_height()
    {
        $garden = self::fromWidthAndHeight(300, 300);
        $garden->shouldHaveType('Jenko\House\Dimensions');
        $garden->getWidth()->shouldEqual(300);
        $garden->getHeight()->shouldEqual(300);
    }

    function it_should_compare_width_and_height_for_equality()
    {
        $newDimensions = Dimensions::fromWidthAndHeight(600, 600);
        $this->equals($newDimensions)->shouldEqual(false);

        $newerDimensions = Dimensions::fromWidthAndHeight(300, 300);
        $this->equals($newerDimensions)->shouldEqual(true);
    }
}
