<?php

namespace Jenko\House\Adapter;

use Tabbi89\CommanderBundle\Event\EventGenerator;

trait CommanderEventGeneratorAdapter
{
    use EventGenerator;

    /**
     * @param $event
     */
    public function raiseEvent($event)
    {
        $this->raise($event);
    }
}