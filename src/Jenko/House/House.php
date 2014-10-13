<?php

namespace Jenko\House;

final class House
{
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
        $this->setLocation(new Room('hallway'));
    }

    /**
     * Exiting the front door is a convenience method for resetting the location
     */
    public function exitFrontDoor()
    {
        $this->resetLocation();
    }

    /**
     * @return Location
     */
    public function whereAmI()
    {
        return $this->location;
    }
}
