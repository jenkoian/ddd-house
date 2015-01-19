<?php

namespace Jenko\HouseCommandHandling\Command;

use SimpleBus\Command\Command;

final class ExitRoomCommand implements Command
{
    const NAME = 'exit-room';

    public $house;
    public $room;

    /**
     * @return string
     */
    public function name()
    {
        return self::NAME;
    }
}
