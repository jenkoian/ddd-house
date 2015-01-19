<?php

namespace Jenko\House\Event;

use Jenko\House\Adapter\SymfonyEventAdapter;

class EnteredRoomEvent extends SymfonyEventAdapter
{
    const NAME = 'house.room-entered';

    public $roomName;
    public $enteredOn;

    /**
     * @param $roomName
     * @param \DateTime $enteredAt
     */
    public function __construct($roomName, \DateTime $enteredAt = null)
    {
        $this->roomName = $roomName;
        $this->enteredAt = $enteredAt ? $enteredAt : new \DateTime();
    }
}
