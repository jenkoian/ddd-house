<?php

namespace Jenko\HouseBundle\CommandBus;

interface CommandTranslatorInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function toCommandHandler($command);
} 