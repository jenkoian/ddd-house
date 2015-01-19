<?php

namespace Jenko\House\Factory;

use Jenko\House\Dimensions;
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

        /**
         * You could take this further and introduce factories for creating gardens, rooms etc. but for our use it's
         * fine.
         */
        $garden = Garden::named('front-garden');
        $hallway = Room::named('hallway');
        $livingRoom = Room::named('living-room');
        $kitchen = Room::named('kitchen');
        $diningRoom = Room::named('dining-room');
        $bathroom = Room::named('bathroom');

        $garden->setDimensions(Dimensions::fromWidthAndHeight(1000, 300));
        $garden->setExits([$hallway]);

        $hallway->setDimensions(Dimensions::fromWidthAndHeight(500, 50));
        $hallway->setExits([$garden, $livingRoom, $diningRoom, $kitchen, $bathroom]);

        $livingRoom->setDimensions(Dimensions::fromWidthAndHeight(600, 300));
        $livingRoom->setExits([$hallway, $diningRoom]);

        $kitchen->setDimensions(Dimensions::fromWidthAndHeight(400, 300));
        $kitchen->setExits([$hallway, $diningRoom]);

        $kitchen->setDimensions(Dimensions::fromWidthAndHeight(300, 200));
        $diningRoom->setExits([$hallway, $kitchen, $livingRoom]);

        $bathroom->setDimensions(Dimensions::fromWidthAndHeight(400, 100));
        $bathroom->setExits([$hallway]);

        $locations = [$garden, $hallway, $livingRoom, $kitchen, $diningRoom, $bathroom];

        static::$house = House::build($locations);

        if (null !== $currentLocation) {
            static::$house->enterRoom($currentLocation);
        }

        return static::$house;
    }
}
