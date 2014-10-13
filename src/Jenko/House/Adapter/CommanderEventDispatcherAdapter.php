<?php

namespace Jenko\House\Adapter;

use Jenko\House\Event\EventDispatcherInterface;
use Tabbi89\CommanderBundle\Event\EventDispatcher;

class CommanderEventDispatcherAdapter implements EventDispatcherInterface
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $events
     * @return mixed|void
     */
    public function dispatch(array $events)
    {
        $this->eventDispatcher->dispatch($events);
    }
} 