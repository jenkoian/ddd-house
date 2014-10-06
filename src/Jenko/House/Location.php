<?php

namespace Jenko\House;

abstract class Location
{
    /**
     * @var string
     */
    private $name;

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
}