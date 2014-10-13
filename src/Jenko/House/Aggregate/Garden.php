<?php

namespace Jenko\House\Aggregate;

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
