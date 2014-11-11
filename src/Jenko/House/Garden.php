<?php

namespace Jenko\House;

final class Garden
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
        return new Garden($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}