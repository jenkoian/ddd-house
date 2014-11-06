<?php

namespace Jenko\House\Aggregate;

abstract class Location
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Dimensions
     */
    private $dimensions;

    /**
     * @var array
     */
    private $exits = [];

    /**
     * @param string $name
     * @param Dimensions $dimensions
     * @param array $exits
     */
    public function __construct($name, Dimensions $dimensions, array $exits = [])
    {
        $this->name = $name;
        $this->dimensions = $dimensions;
        $this->exits = $exits;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $exits
     */
    public function setExits(array $exits)
    {
        $this->exits = $exits;
    }

    /**
     * @param $location
     * @return bool
     */
    public function equals(Location $location)
    {
        return $location->getName() === $this->getName();
    }

    /**
     * @return array
     */
    public function getExits()
    {
        return $this->exits;
    }

    /**
     * @return Dimensions
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @return array
     */
    public function getInformation()
    {
        return [
            'dimensions' => (string) $this->getDimensions(),
            'exits' => $this->getExits()
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}
