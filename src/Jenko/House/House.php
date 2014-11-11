<?php

namespace Jenko\House;

final class House
{
    /**
     * @var array
     */
    private $locations;

    /**
     * @param array $locations
     */
    private function __construct(array $locations)
    {
        $this->locations = $locations;
    }

    /**
     * @param array $locations
     * @return House
     */
    public static function build(array $locations)
    {
        return new House($locations);
    }

    /**
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }
}
