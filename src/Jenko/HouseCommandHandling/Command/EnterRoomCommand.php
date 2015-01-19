<?php

namespace Jenko\HouseCommandHandling\Command;

use SimpleBus\Command\Command;

final class EnterRoomCommand implements Command
{
    const NAME = 'enter-room';

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
