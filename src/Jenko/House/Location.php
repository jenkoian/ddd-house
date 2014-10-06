<?php

namespace Jenko\House;

final class Location
{
    const DEFAULT_LOCATION = 'outside';

    private $name;

    /**
     * @param string $name
     */
    public function __construct($name = self::DEFAULT_LOCATION)
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
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }
}
