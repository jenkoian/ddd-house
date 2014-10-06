<?php

namespace Jenko\House;

final class Room extends Location
{
    /**
     * @param string $name
     * @return Room
     */
    public static function named($name)
    {
        return new Room($name);
    }
}