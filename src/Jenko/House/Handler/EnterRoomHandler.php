<?php

namespace Jenko\House\Handler;

use Jenko\House\Aggregate\Dimensions;
use Jenko\House\Aggregate\Garden;
use Jenko\House\Aggregate\House;
use Jenko\House\Aggregate\Room;
use Jenko\House\Event\EventDispatcherInterface;

class EnterRoomHandler implements CommandHandlerInterface
{
    protected $dispatcher;
    protected $house;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $kitchen = new Room('kitchen', new Dimensions(300, 100));
        $lounge = new Room('living-room', new Dimensions(400, 300));
        $hallway = new Room('hallway', new Dimensions(300, 800));
        $garden = new Garden('front garden', new Dimensions(600,80));
        $kitchen->setExits([$hallway]);
        $lounge->setExits([$kitchen]);
        $hallway->setExits([$lounge]);
        $garden->setExits([$hallway]);

        $locations =  [$lounge, $kitchen, $hallway, $garden];
        $this->house = House::buildHouse($locations);
    }

    /**
     * @param $command
     * @return mixed|void
     */
    public function handle($command)
    {
        $this->house->enterRoom($command->room);
        $this->dispatcher->dispatch($this->house->releaseEvents());

        return $this->house;
    }
}
