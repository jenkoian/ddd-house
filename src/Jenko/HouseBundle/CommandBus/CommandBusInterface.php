<?php

namespace Jenko\HouseBundle\CommandBus;

interface CommandBusInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function execute($command);
} 