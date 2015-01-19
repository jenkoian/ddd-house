<?php

namespace Jenko\House\Event;

class EnteredRoomEvent
{
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
