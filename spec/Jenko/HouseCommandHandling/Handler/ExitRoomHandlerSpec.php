<?php

namespace spec\Jenko\HouseCommandHandling\Handler;

use Jenko\HouseCommandHandling\Command\ExitRoomCommand;
use Jenko\House\Event\EventDispatcherInterface;
use Jenko\House\Factory\HomeAloneHouseFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExitRoomHandlerSpec extends ObjectBehavior
{
    function let(EventDispatcherInterface $dispatcher)
    {
        $this->beConstructedWith($dispatcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\HouseCommandHandling\Handler\ExitRoomHandler');
    }

    function it_dispatches_events(EventDispatcherInterface $dispatcher)
    {
        $house = HomeAloneHouseFactory::getHouse();
        $house->enterRoom('hallway');

        $command = new ExitRoomCommand();
        $command->room = 'kitchen';

        $dispatcher->dispatch(Argument::any())->shouldBeCalled();
        $this->handle($command);
    }
}
