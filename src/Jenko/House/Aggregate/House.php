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
    public static function buildHouse(array $locations)
    {
        return new self($locations);
    }

    /**
     * Reset location to default
     */
    public function resetCurrentLocation()
    {
        foreach ($this->locations as $location) {
            if ($location instanceof Garden) {
                return $this->currentLocation = $location;
            }
        }

        return $this->currentLocation = $this->locations[0];
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
            $room = new Room($room, new Dimensions(1,1), []);
        }

        if (!$this->containsLocation($room)) {
            throw new RoomDoesNotExistException('Sorry, that room does not exist');
        }

        foreach ($this->locations as $location) {
            if ($location->equals($room)) {
                $this->currentLocation = $location;
                $this->raiseEvent(new RoomEnteredEvent($location->getName()));
                return;
            }
        }
    }

    /**
     * @param Location $room
     * @return bool
     */
    private function containsLocation(Location $room)
    {
        foreach ($this->locations as $location)
        {
            if ($location->equals($room)) {
                return true;
            }
        }

        return false;
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
}
