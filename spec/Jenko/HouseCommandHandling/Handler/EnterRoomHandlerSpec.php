<?php

namespace spec\Jenko\HouseCommandHandlingHandler;

use Jenko\House\Event\EventDispatcherInterface;
use Jenko\House\Factory\HomeAloneHouseFactory;
use Jenko\HouseCommandHandling\Command\EnterRoomCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnterRoomHandlerSpec extends ObjectBehavior
{
    function let(EventDispatcherInterface $dispatcher)
    {
        $this->beConstructedWith($dispatcher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenko\HouseCommandHandling\Handler\EnterRoomHandler');
    }

    function it_dispatches_events(EventDispatcherInterface $dispatcher)
    {
        $house = HomeAloneHouseFactory::getHouse();
        $house->enterRoom('hallway');

        $command = new EnterRoomCommand();
        $command->room = 'kitchen';

        $dispatcher->dispatch(Argument::any())->shouldBeCalled();
        $this->handle($command);
    }
}
