<?php

namespace Jenko\House\Factory;

use Jenko\House\Garden;
use Jenko\House\House;
use Jenko\House\Room;

/**
 * Note: Usually you would have some kind of persistence mechanism. However, in our case a static factory (essentially
 * a singleton) is fine, as the house itself won't change.
 */
final class HomeAloneHouseFactory implements HouseFactory
{
    /**
     * @var House $house
     */
    private static $house;

    /**
     * {@inheritdoc}
     */
    public static function getHouse($currentLocation = null)
    {
        if (isset(static::$house)) {
            return static::$house;
        }

        $locations = [
            Garden::named('front garden'),
            Room::named('hallway'),
            Room::named('living room'),
            Room::named('kitchen'),
        ];

        static::$house = House::build($locations);

        if (null !== $currentLocation) {
            static::$house->enterRoom($currentLocation);
        }

        return static::$house;
    }
}
