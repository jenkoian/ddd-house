<?php

namespace Jenko\House\Handler;

use Jenko\House\Factory\HomeAloneHouseFactory;

final class EnterRoomHandler
{
    private $house;

    public function __construct()
    {
        $this->house = HomeAloneHouseFactory::getHouse();
    }

    /**
     * @param $command
     * @return mixed|void
     */
    public function handle($command)
    {
        $this->house->enterRoom($command->room);
    }
}
