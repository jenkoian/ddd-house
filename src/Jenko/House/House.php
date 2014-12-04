<?php

namespace Jenko\House;

use Jenko\House\Event\EnteredRoomEvent;
use Jenko\House\Event\EventGenerator;
use Jenko\House\Exception\LocationDoesNotExistException;

final class House
{
    use EventGenerator;

    /**
     * @var array
     */
    private $locations;

    /**
     * @var Location
     */
    private $currentLocation;

    /**
     * @var Location
     */
    private $previousLocation;

    /**
     * @param array $locations
     */
    private function __construct(array $locations)
    {
        $this->locations = $locations;
    }

    /**
     * @param array $locations
     * @return House
     */
    public static function build(array $locations)
    {
        return new House($locations);
    }

    /**
     * @return Location[]|array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @return Location
     */
    public function whereAmI()
    {
        return $this->currentLocation;
    }

    /**
     * @return Location
     */
    public function whereWasI()
    {
        return $this->previousLocation;
    }

    /**
     * @param Room|string $room
     * @return $this
     * @throws LocationDoesNotExistException
     */
    public function enterRoom($room)
    {
        if (!$room instanceof Room && is_string($room)) {
            $room = $this->findLocationFromName($room);
        }

        if (!$this->containsLocation($room)) {
            throw new LocationDoesNotExistException;
        }

        $this->previousLocation = $this->currentLocation;
        $this->currentLocation = $room;

        $this->raiseEvent(new EnteredRoomEvent($this->currentLocation->getName()));

        return $this;
    }

    /**
     * @param string $roomName
     * @return Location|null
     * @throws LocationDoesNotExistException
     */
    private function findLocationFromName($roomName)
    {
        foreach ($this->getLocations() as $location) {
            if ($location->getName() === $roomName) {
                return $location;
            }
        }

        throw new LocationDoesNotExistException;
    }

    /**
     * @param Location $location
     * @return bool
     */
    private function containsLocation(Location $location)
    {
        foreach ($this->getLocations() as $existingLocation) {
            if ($location == $existingLocation) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Location|string $room
     * @return House
     */
    public function exitToRoom($room)
    {
        return $this->enterRoom($room);
    }
}
