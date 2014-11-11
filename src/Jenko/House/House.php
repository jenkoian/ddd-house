<?php

namespace Jenko\House;

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
     */
    public function enterRoom($room)
    {
        if (!$room instanceof Room && is_string($room)) {
            $room = Room::named($room);
        }

        $this->currentLocation = $room;
    }

    /**
     * @param Location|string $room
     */
    public function exitRoom($room)
    {
        if (!$room instanceof Location && is_string($room)) {
            if (false !== strpos('garden', $room)) {
                $room = Garden::named($room);
            } else{
                $room = Room::named($room);
            }
        }

        $this->currentLocation = $room;
    }
}
