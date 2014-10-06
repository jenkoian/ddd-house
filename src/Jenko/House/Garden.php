<?php

namespace Jenko\House;

final class Garden extends Location
{
    /**
     * @param string $name
     * @return Room
     */
    public static function named($name)
    {
        return new Garden($name);
    }
}