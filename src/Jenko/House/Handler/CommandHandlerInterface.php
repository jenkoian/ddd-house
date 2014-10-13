<?php

namespace Jenko\House\Handler;

interface CommandHandlerInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);
} 