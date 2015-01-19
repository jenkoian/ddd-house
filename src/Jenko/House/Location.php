<?php

namespace Jenko\House;

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
     * @var Location[]|array
     */
    private $exits;

    /**
     * @param string $name
     */
    protected function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getInformation()
    {
        return ['dimensions' => (string)$this->getDimensions(), 'exits' => $this->getExits()];
    }

    /**
     * @param Dimensions $dimensions
     */
    public function setDimensions(Dimensions $dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @return Dimensions
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param array $exits
     */
    public function setExits(array $exits)
    {
        $this->exits = $exits;
    }

    /**
     * @return array|Location[]
     */
    public function getExits()
    {
        return $this->exits;
    }
}