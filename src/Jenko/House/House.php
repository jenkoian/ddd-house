<?php

namespace Jenko\House;

final class House
{
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
        $this->location = new Location();
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Entering via the front door will always take you into the hallway.
     */
    public function enterFrontDoor()
    {
        $this->setLocation(new Location('hallway'));
    }

    /**
     * Exiting the front door is a convenience method for resetting the location
     */
    public function exitFrontDoor()
    {
        $this->resetLocation();
    }

    /**
     * @return mixed
     */
    public function whereAmI()
    {
        return $this->location;
    }
}
