<?php

namespace spec\Jenko\House\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HomeAloneHouseFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\House\Factory\HomeAloneHouseFactory');
        $this->shouldHaveType('Jenko\House\Factory\HouseFactoryInterface');
    }

    function it_should_return_a_house()
    {
        self::getHouse()->shouldHaveType('Jenko\House\House');
    }
}
