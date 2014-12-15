<?php

namespace Jenko\HouseCommandHandling\Handler;

use Jenko\House\Event\EventDispatcherInterface;
use Jenko\House\Factory\HomeAloneHouseFactory;
use Jenko\House\House;
use SimpleBus\Command\Command;
use SimpleBus\Command\Handler\CommandHandler;

final class EnterRoomHandler implements CommandHandler
{
    /**
     * @var House $house
     */
    private $house;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->house = HomeAloneHouseFactory::getHouse();
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param $command
     * @return mixed|void
     */
    public function handle(Command $command)
    {
        $house = $this->house->enterRoom($command->room);
        $this->dispatcher->dispatch($house->releaseEvents());
    }
}
