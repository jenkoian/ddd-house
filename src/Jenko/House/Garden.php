<?php

namespace Jenko\House;

final class Garden extends Location
{
    /**
     * @return string
     */
    protected function getDefaultName()
    {
        return 'front garden';
    }
}
