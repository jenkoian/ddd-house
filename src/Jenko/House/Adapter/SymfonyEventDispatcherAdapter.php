<?php

namespace Jenko\House\Adapter;

use Jenko\House\Event\EventDispatcherInterface as LocalEventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SymfonyEventDispatcherAdapter implements LocalEventDispatcherInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;
    /**
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
    /**
     * {@inheritdoc}
     */
    public function dispatch(array $events)
    {
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event::NAME, $event);
        }
    }
}
