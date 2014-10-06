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
     * @param Location $room
     */
    public function enterRoom(Location $room)
    {
        $this->currentLocation = $room;
    }
}
