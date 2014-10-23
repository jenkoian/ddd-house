<?php

namespace Jenko\House\Aggregate;

abstract class Location
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $information = [];

    /**
     * @param string $name
     * @param array $information
     */
    public function __construct($name = null, array $information = [])
    {
        $this->name = $name ? $name : $this->getDefaultName();
        $this->information = $information ? $information : $this->getDefaultInformation();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $information
     */
    public function setInformation(array $information)
    {
        $this->information = $information;
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
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    abstract protected function getDefaultName();

    /**
     * @return array
     */
    abstract protected function getDefaultInformation();
}
