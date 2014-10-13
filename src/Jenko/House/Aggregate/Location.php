<?php

namespace Jenko\House\Aggregate;

abstract class Location
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name = null)
    {
        $this->name = $name ? $name : $this->getDefaultName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getInformation()
    {
        $rooms = ['kitchen', 'living-room', 'dining-room', 'hallway'];
        return [
            'size' => '300 x 200',
            'rooms' => [
                $rooms[array_rand($rooms)]
            ]
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    abstract protected function getDefaultName();
}
