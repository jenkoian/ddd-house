<?php

namespace Jenko\House\Aggregate;

use Jenko\House\Adapter\CommanderEventGeneratorAdapter;
use Jenko\House\Event\RoomEnteredEvent;
use Jenko\House\Exception\RoomDoesNotExistException;

final class House
{
    use CommanderEventGeneratorAdapter;

    /**
     * @var Location
     */
    private $currentLocation;

    /**
     * @var array
     */
    private $locations;

    /**
     * When a new house is instantiated, ensure the location is reset.
     *
     * @param array $locations
     */
    private function __construct(array $locations)
    {
        $this->locations = $locations;
        $this->resetCurrentLocation();
    }

    /**
     * @param array $locations
     * @return House
     */
    public static function buildHouse(array $locations = array())
    {
        if (empty($locations)) {
            $locations = static::getDefaultLocations();
        }

        return new House($locations);
    }

    /**
     * Reset location to default
     */
    public function resetCurrentLocation()
    {
        $this->currentLocation = new Garden();
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
        $this->resetCurrentLocation();
    }

    /**
     * Convenience method for entering a room, basically a wrapper for setLocation. Pass it a room object or a room name
     *
     * @param mixed $room
     * @throws RoomDoesNotExistException
     */
    public function enterRoom($room)
    {
        if (!($room instanceof Room)) {
            $room = new Room($room);
        }

        if (!in_array($room, $this->locations)) {
            throw new RoomDoesNotExistException('Sorry, that room does not exist');
        }

        $this->currentLocation = $room;
        $this->raiseEvent(new RoomEnteredEvent($room->getName()));
    }

    /**
     * @return Location
     */
    public function whereAmI()
    {
        return $this->currentLocation;
    }

    /**
     * @return Location[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * If no locations are set, default to a garden and a hallway. Every house must have a garden and a hall.
     *
     * @return Location[]
     */
    public static function getDefaultLocations()
    {
        return [
            new Garden(),
            new Room()
        ];
    }
}
