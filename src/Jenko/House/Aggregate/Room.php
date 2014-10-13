<?php

namespace Jenko\House\Aggregate;

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
