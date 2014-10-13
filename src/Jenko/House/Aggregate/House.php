<?php

namespace Jenko\House\Aggregate;

use Jenko\House\Adapter\CommanderEventGeneratorAdapter;
use Jenko\House\Event\RoomEnteredEvent;

final class House
{
    use CommanderEventGeneratorAdapter;

    /**
     * @var Location
     */
    private $location;

    /**
     * When a new house is instantiated, ensure the location is reset.
     */
    public function __construct()
    {
        $this->resetLocation();
    }

    /**
     * Reset location to default
     */
    public function resetLocation()
    {
        $this->location = new Garden();
    }

    /**
     * Entering via the front door will always take you into the hallway.
     */
    public function enterFrontDoor()
    {
        $this->enterRoom('hallway');
    }

    /**
     * Exiting the front door is a convenience method for resetting the location.
     */
    public function exitFrontDoor()
    {
        $this->resetLocation();
    }

    /**
     * Convenience method for entering a room, basically a wrapper for setLocation. Pass it a room object or a room name
     *
     * @param mixed $room
     */
    public function enterRoom($room)
    {
        if (!($room instanceof Room)) {
            $room = new Room($room);
        }

        $this->location = $room;
        $this->raiseEvent(new RoomEnteredEvent($room->getName()));
    }

    /**
     * @return Location
     */
    public function whereAmI()
    {
        return $this->location;
    }
}
