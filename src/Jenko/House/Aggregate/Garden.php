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
