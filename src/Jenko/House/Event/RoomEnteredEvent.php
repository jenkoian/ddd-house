<?php

namespace Jenko\House\Event;

use Jenko\House\Adapter\SymfonyEventAdapter;

class RoomEnteredEvent extends SymfonyEventAdapter
{
    public $roomName;
    public $enteredAt;

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
