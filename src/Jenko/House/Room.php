<?php

namespace Jenko\House;

final class Room
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    private function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return Room
     */
    public static function named($name)
    {
        return new Room($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}