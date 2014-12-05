<?php

namespace Jenko\House\Event;

interface EventSubscriberInterface
{
    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents();
}
