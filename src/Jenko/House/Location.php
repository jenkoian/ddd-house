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
        return ['dimensions' => (string)$this->getDimensions(), 'exits' => ''];
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
}