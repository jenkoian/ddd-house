<?php

namespace Jenko\House\Handler;

use Jenko\House\Event\EventDispatcherInterface;
use Jenko\House\Factory\HomeAloneHouseFactory;
use Jenko\House\House;

final class EnterRoomHandler implements HandlerInterface
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
    public function handle($command)
    {
        $house = $this->house->enterRoom($command->room);
        $this->dispatcher->dispatch($house->releaseEvents());

        return $house;
    }
}
