<?php

namespace Jenko\House\Handler;

use Jenko\House\Aggregate\House;
use Jenko\House\Event\EventDispatcherInterface;

class EnterRoomHandler implements CommandHandlerInterface
{
    protected $dispatcher;
    protected $house;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->house = new House();
    }

    /**
     * @param $command
     * @return mixed|void
     */
    public function handle($command)
    {
        $this->house->enterRoom($command->room);
        $this->dispatcher->dispatch($this->house->releaseEvents());
    }
}
