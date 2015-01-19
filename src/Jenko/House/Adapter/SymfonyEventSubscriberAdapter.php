<?php

namespace Jenko\House\Adapter;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class SymfonyEventSubscriberAdapter implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return static::getSubscribedEvents();
    }
}
