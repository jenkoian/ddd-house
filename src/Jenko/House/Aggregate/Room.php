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

    /**
     * @return array
     */
    protected function getDefaultInformation()
    {
        return [
            'size' => '300 x 200',
            'rooms' => []
        ];
    }
}
