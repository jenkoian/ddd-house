<?php

namespace Jenko\House;

final class Room extends Location
{
    /**
     * @return string
     */
    protected function getDefaultName()
    {
        return 'hallway';
    }
}
