<?php

namespace Jenko\House\Handler;

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
        $kitchen = new Room('kitchen');
        $hallway = new Room('hallway');
        $garden = new Garden('front garden');
        $kitchen->setInformation(['size' => '300 x 300', 'rooms' => []]);
        $hallway->setInformation(['size' => '300 x 300', 'rooms' => [$kitchen]]);
        $garden->setInformation(['size' => '300 x 300', 'rooms' => [$hallway]]);

        $locations =  [$kitchen, $hallway, $garden];
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
