<?php

namespace Jenko\House;

use Jenko\House\Exception\LocationDoesNotExistException;

final class House
{
    /**
     * @var array
     */
    private $locations;

    /**
     * @var Location
     */
    private $currentLocation;

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
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param Location $location
     * @return $this
     */
    public function setLocation(Location $location)
    {
        $this->currentLocation = $location;

        return $this;
    }

    /**
     * @return Location
     */
    public function whereAmI()
    {
        return $this->currentLocation;
    }

    /**
     * @param Room|string $room
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

        $this->currentLocation = $room;
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
     * @throws LocationDoesNotExistException
     */
    public function exitRoom($room)
    {
        if (!$room instanceof Location && is_string($room)) {
            if (false !== strpos($room, 'garden')) {
                $room = Garden::named($room);
            } else{
                $room = Room::named($room);
            }
        }

        if (!$this->containsLocation($room)) {
            throw new LocationDoesNotExistException;
        }

        $this->currentLocation = $room;
    }
}