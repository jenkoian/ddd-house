<?php

namespace Jenko\House\Aggregate;

abstract class Location
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name = null)
    {
        $this->name = $name ? $name : $this->getDefaultName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
}
