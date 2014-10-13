<?php

namespace Jenko\House\Event;

interface EventDispatcherInterface
{
    /**
     * @param array $events
     * @return mixed
     */
    public function dispatch(array $events);
} 